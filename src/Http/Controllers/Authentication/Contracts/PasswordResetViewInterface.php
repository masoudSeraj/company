<?php namespace Sunnyr\Company\Http\Controllers\Authentication\Contracts;

interface PasswordResetViewInterface
{
    public function view($userId);
}