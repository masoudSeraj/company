<?php

namespace Sunnyr\Company\Http\Middleware;

use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Sunnyr\Company\Enums\Status;
use Sunnyr\Company\Models\Social;
use Sunnyr\Company\Models\Settings;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Sunnyr\Company\Http\Resources\SocialResource;
use Sunnyr\Company\Http\Resources\SettingsResource;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'company::app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            // 'ziggy' => function () use ($request) {
            //     return array_merge((new Ziggy)->toArray(), [
            //         'location' => $request->url(),
            //     ]);
            // },
            'auth' => [
                'user'          =>      $request->user(),
                'canLogin'      =>      Route::has('fortify.auth.login'),
                'canRegister'   =>      Route::has('fortify.auth.register'),
                'isVerifiedUser'      =>      $request?->user()?->verified_at ? true : false,
            ],
            'backgroundImage'  =>  asset('storage/'.'background.jpg'),
            'root'          =>      'https://sunnyrlube.com',
            'logo'          =>      Storage::disk('company')->url('logo-small.png'),
            'settings'      =>      SettingsResource::collection(Settings::where('is_active', Status::ACTIVE)->get()),
            'socials'       =>      SocialResource::collection(Social::with('icon')->where('is_active', Status::ACTIVE)->get()),
        ]);
    }
}
