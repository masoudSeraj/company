<?php

namespace Sunnyr\Company;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Sunnyr\Company\Http\Services\UserService;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Sunnyr\Company\Actions\Fortify\CreateNewUser;
use Sunnyr\Company\Http\Services\SettingsService;
use Sunnyr\Company\Contracts\UserServiceInterface;
use Sunnyr\Company\Http\Services\ContactusService;
use Sunnyr\Company\Http\Middleware\UserIsNotVerified;
use Sunnyr\Company\Http\Services\PasswordResetService;
use Sunnyr\Company\Contracts\ContactusServiceInterface;
use Sunnyr\Company\Contracts\RegisterUserAsAgentInterface;
use Sunnyr\Company\Http\Middleware\HandleInertiaRequests;
use Sunnyr\Company\Http\Controllers\Authentication\Contracts\PasswordResetInterface;
use Sunnyr\Company\Http\Controllers\Authentication\Contracts\PasswordResetViewInterface;
use Sunnyr\Company\Http\Services\Agent\RegisterUserAsAgentService;

class CompanyServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->bind('settings', function ($app) {
      return new SettingsService();
    });

    $this->app->bind(PasswordResetInterface::class, PasswordResetService::class);
    $this->app->bind(PasswordResetViewInterface::class, PasswordResetService::class);
    $this->app->bind(UserServiceInterface::class, UserService::class);
    $this->app->bind(CreatesNewUsers::class, CreateNewUser::class);
    $this->app->bind(ContactusServiceInterface::class, ContactusService::class);
    $this->app->bind(RegisterUserAsAgentInterface::class, RegisterUserAsAgentService::class);

  }

  public function boot()
  {
    // $kernel = $this->app->make(Kernel::class);

    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    $this->loadRoutesFrom(__DIR__.'/../routes/api.php');


    $this->loadViewsFrom(__DIR__.'/../resources/views', 'company');

    $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'company');

    if ($this->app->runningInConsole()) {

        $this->publishes([
          __DIR__.'/../config/config.php' => config_path('company.php'),
        ], 'company-config');

        $this->publishes([
            __DIR__.'/../resources/assets/images' => storage_path('app/public/themes/company'),
        ], 'company-images');

        $this->publishes([
          __DIR__ . '/../database/migrations/2023_04_09_100000_create_company_sliders_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_company_sliders_table.php'),
          __DIR__ . '/../database/migrations/2023_04_09_100001_create_company_slider_types_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()+1) . '_create_company_slider_types_table.php'),
          __DIR__ . '/../database/migrations/2023_04_16_100001_create_resumes_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_resumes_table.php'),
          __DIR__ . '/../database/migrations/2023_04_24_100001_create_settings_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_settings_table.php'),
          __DIR__ . '/../database/migrations/2023_04_25_100001_create_icons_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_icons_table.php'),
          __DIR__ . '/../database/migrations/2023_04_26_100001_create_socials_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_socials_table.php'),
          __DIR__ . '/../database/migrations/2023_05_29_100001_create_agents_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()+1) . '_create_agents_table.php'),
          __DIR__ . '/../database/migrations/2023_05_29_100002_create_companies_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()+2) . '_create_companies_table.php'),
          __DIR__ . '/../database/migrations/2023_05_29_100003_create_agent_company_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()+3) . '_create_agent_company_table.php'),
          // __DIR__ . '/../database/migrations/2023_05_29_100004_create_requests_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()+4) . '_create_requests_table.php'),
          __DIR__ . '/../database/migrations/2023_07_05_100000_create_contact_us_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()+5) . '_create_contact_us_table.php'),

        ], 'company-migrations');

        // if(!file_exists('CreateContactusTable')){
        //   $this->publishes([
        //     __DIR__ . '/../database/migrations/2023_07_05_100000_create_contact_us_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()+5) . '_create_contact_us_table.php'),
        //   ], 'company-contactus');  
        // }

          $this->publishes([
            __DIR__ . '/../database/seeders/CompanySeeder.php.stub' => database_path('seeders/CompanySeeder.php'),
          ], 'company-seeders');
      }

    $kernel = $this->app->make(Kernel::class);
    // $kernel->pushMiddleware(HandleInertiaRequests::class);
    $kernel->appendMiddlewareToGroup('web', HandleInertiaRequests::class);
    $kernel->appendToMiddlewarePriority(HandleInertiaRequests::class);

    $router = $this->app->make(Router::class);
    $router->aliasMiddleware('isVerified', UserIsNotVerified::class);    

    Fortify::loginView(function () {
      return Inertia::render('Auth/Login', [
          'canResetPassword' => Route::has('fortify.auth.password.request'),
          'status' => session('status'),
      ]);
    });

  Fortify::resetPasswordView(function (Request $request) {
      return Inertia::render('Auth/ResetPassword', [
          'email' => $request->input('email'),
          'token' => $request->route('token'),
      ]);
  });

  Fortify::registerView(function () {
      return Inertia::render('Auth/Register');
  });

  Fortify::verifyEmailView(function () {
      return Inertia::render('Auth/VerifyEmail', [
          'status' => session('status'),
      ]);
  });

  Fortify::twoFactorChallengeView(function () {
      return Inertia::render('Auth/TwoFactorChallenge');
  });

  Fortify::confirmPasswordView(function () {
      return Inertia::render('Auth/ConfirmPassword');
  });


  $this->oneTimeCodeRateLimiter();
  $this->requestCodeRateLimiter();
  $this->submitPhoneumberRateLimiter();

  }

  protected function oneTimeCodeRateLimiter(){
    RateLimiter::for('one-time-code-generator', function (Request $request) {
      return Limit::perMinutes(config('company.throttle.request-verification.time'), config('company.throttle.request-verification.visits'))->by($request->user()?->id ?: $request->ip())->response(function (Request $request, array $headers) {
        return response('کد در حال حاضر برای شما ارسال شده است', 429, $headers);
    });
  });
  }

  protected function requestCodeRateLimiter(){
    RateLimiter::for('one-time-code-submit', function (Request $request) {
      return Limit::perMinutes(config('company.throttle.submit-verification.time'), config('company.throttle.submit-verification.visits'))->by($request->user()?->id ?: $request->ip())->response(function (Request $request, array $headers) {
        return response("تعداد دفعات ورود کد تایید اشتباه است. لطفا پس از " . $headers['Retry-After']  ."  ثانیه دوباره درخواست دهید!", 429, $headers);
      });
    });
  }

  protected function submitPhoneumberRateLimiter(){
    RateLimiter::for('submit-phonenumber', function (Request $request) {
      return Limit::perMinutes(config('company.throttle.submit-verification.time'), config('company.throttle.submit-verification.visits'))->by($request->user()?->id ?: $request->ip())->response(function (Request $request, array $headers) {
        return response("تعداد دفعات ورود کد تایید اشتباه است. لطفا پس از " . $headers['Retry-After']  ." ثانیه دوباره درخواست دهید!", 429, $headers);
      });
    });
  }
}
