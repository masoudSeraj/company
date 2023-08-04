<?php

namespace Sunnyr\Company\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class OneTimeCodeNotValid extends Exception
{
    public function report()
    {
    }

    public function render($request)
    {
        // return response()->json(['message' => 'کد اشتباه است. دوباره تلاش کنید!'], Response::HTTP_BAD_REQUEST);

        dd($request->all());
        // return 'خطایی رخ داد!';
    }
}
