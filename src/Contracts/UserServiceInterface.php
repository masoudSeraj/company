<?php namespace Sunnyr\Company\Contracts;

use Throwable;
use App\Models\User;


interface UserServiceInterface
{
    public function getUser($field, $value) : User | Throwable;
}