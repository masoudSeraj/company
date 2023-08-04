<?php

use Laravel\Fortify\Features;
use Laravel\Fortify\RoutePath;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Sunnyr\Company\Http\Controllers\Agents\RegisterAgentController;
use Sunnyr\Company\Http\Controllers\Agents\RegisterUserAsAgentController;
use Sunnyr\Company\Http\Controllers\Users\UserActivationController;
use Sunnyr\Company\Http\Controllers\Authentication\PasswordForgotController;
use Sunnyr\Company\Http\Controllers\Authentication\AuthenticatedSessionController;
use Sunnyr\Company\Http\Controllers\Authentication\PasswordResetController;

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    $enableViews = config('fortify.views', true);

    // Authentication...
    if ($enableViews) {
        Route::get(RoutePath::for('login', '/login'), [AuthenticatedSessionController::class, 'create'])
            // ->middleware(['guest:'.config('fortify.guard')])
            ->middleware(['isNotVerified', 'guest'])
            ->name('login');
    }

    $limiter = config('fortify.limiters.login');
    $twoFactorLimiter = config('fortify.limiters.two-factor');
    $verificationLimiter = config('fortify.limiters.verification', '6,1');

    Route::post(RoutePath::for('login', '/login'), [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:'.config('fortify.guard'),
            $limiter ? 'throttle:'.$limiter : null,
        ]))->name('submit-login');

    Route::post(RoutePath::for('logout', '/logout'), [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');

    // Password Reset...
    if (Features::enabled(Features::resetPasswords())) {
        if ($enableViews) {            
            Route::get(RoutePath::for('password.phone.request', '/forgot-password-phone-request'), [PasswordForgotController::class, 'create'])
            // ->middleware(['guest:'.config('fortify.guard')])
                ->middleware('guest')
                ->name('password.phone.request');

            Route::get(RoutePath::for('password.phone.reset', '/reset-password-phone/{userId}'), [PasswordResetController::class, 'create'])
            // ->middleware(['guest:'.config('fortify.guard')])
            // ->middleware('auth')
            ->name('password.phone.reset');
        }

        Route::post(RoutePath::for('password.phone', '/forgot-password-phone'), [PasswordForgotController::class, 'store'])
        // ->middleware(['guest:'.config('fortify.guard')])
            ->middleware(['throttle:submit-phonenumber'])
            ->name('password.phone');

        Route::post(RoutePath::for('password.phone.reset', '/reset-password-phone-apply'), [PasswordResetController::class, 'store'])
        // ->middleware(['guest:'.config('fortify.guard')])
            ->name('password.phone.reset.apply')
            ->middleware('auth');
    }

    // Registration...
    if (Features::enabled(Features::registration())) {
        if ($enableViews) {
            Route::get(RoutePath::for('register', '/register'), [RegisteredUserController::class, 'create'])
                // ->middleware(['guest:'.config('fortify.guard')])
                ->middleware(['isNotVerified', 'guest'])
                ->name('register');

            Route::get(RoutePath::for('register-user-as-agent', '/register-user-as-agent'),[RegisterUserAsAgentController::class, 'index'])
                ->middleware(['agent', 'agentNotCreated'])
                ->name('register-user-as-agent');
        }

        Route::post(RoutePath::for('register', '/register'), [RegisterAgentController::class, 'store'])
            ->middleware('guest')
            ->middleware(['guest:'.config('fortify.guard')]);

        Route::post(RoutePath::for('register-user-as-agent', '/register-user-as-agent'), [RegisterUserAsAgentController::class, 'store'])
            ->middleware(['auth'])
            ->name('register-user-as-agent.post');
    }

    // Phone Verification
    if(Features::enabled('verification')) {
        if ($enableViews) {
            Route::get(RoutePath::for('verify-phone', '/verify-phone/{id?}/{redirection?}'), [UserActivationController::class, 'create'])
                // ->middleware(['guest:'.config('fortify.guard')])
                ->name('verification');
        }

        Route::get(RoutePath::for('request-for-verification/{id}', '/request-for-verification/{id}'), [UserActivationController::class, 'generateCode'])
        // ->middleware(['guest:'.config('fortify.guard')])
            ->middleware(['throttle:one-time-code-generator'])
            ->name('request.verification');
        
        
        Route::post(RoutePath::for('submit-verification', '/submit-verification'), [UserActivationController::class, 'submit'])
        // ->middleware(['guest:'.config('fortify.guard')])
            ->middleware(['throttle:one-time-code-submit'])
            ->name('submit.verification');
    }

});
