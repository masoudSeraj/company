<?php

namespace App\Exceptions;

use Exception;

class UserAsAgentException extends Exception
{
    public function report()
    {
    }

    public function render($request)
    {
        return response(['error' => 'خطایی رخ داد']);
    }
}
