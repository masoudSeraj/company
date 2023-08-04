<?php namespace Sunnyr\Company\Http\Services\Agent;

use Laravel\Fortify\Contracts\RegisterResponse;

class RegisterResponseService implements RegisterResponse
{
    public function toResponse($request)
    {
        return redirect()->route('fortify.auth.verification');
    }
}

