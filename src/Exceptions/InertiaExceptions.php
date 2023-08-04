<?php

namespace Sunnyr\Company\Exceptions;

use Exception;
use Throwable;
use Inertia\Inertia;

class InertiaExceptions extends Exception
{
    public function render($request, Throwable $e)
    {
        dd('no');
        // $response = parent::render($request, $e);

        // dd($response);
        // if (!app()->environment(['local', 'testing']) && in_array($response->status(), [500, 503, 404, 403, 429])) {
        //     return Inertia::render('Error', ['status' => $response->status()])
        //         ->toResponse($request)
        //         ->setStatusCode($response->status());
        // } elseif ($response->status() === 419) {
        //     return back()->with([
        //         'message' => 'The page expired, please try again.',
        //     ]);
        // }

        // return $response;
    }
}
