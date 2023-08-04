<?php

namespace Sunnyr\Company\Http\Controllers\Authentication;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Responsable;
use Sunnyr\Company\Http\Controllers\Authentication\Contracts\PasswordResetInterface;
use Sunnyr\Company\Http\Services\UserFoundResponse;
use Sunnyr\Company\Http\Services\PasswordResetService;
use Sunnyr\Company\Http\Services\UserNotFoundResponse;

class PasswordForgotController extends Controller
{
    public function __construct(public PasswordResetInterface $passwordResetInterface)
    {

    }

    public function create()
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(Request $request)
    {
        $request->validate([Fortify::username() => ['required', 'regex:/^(\\+98|0)?9\\d{9}$/']]);

        $status = $this->passwordResetInterface->checkUser(
            $request->only(Fortify::username())
        );

        return $status == PasswordResetService::USER_FOUND
                    ? app(UserFoundResponse::class, ['status' => $status])->toResponse($request)
                    : app(UserNotFoundResponse::class, ['status' => $status])->toResponse($request);
    }
}
