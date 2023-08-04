<?php namespace Sunnyr\Company\Http\Controllers\Authentication\Contracts;

use Illuminate\Http\Request;

interface PasswordResetInterface
{
    public function checkUser(array $credentials);

    public function reset(Request $request);
}