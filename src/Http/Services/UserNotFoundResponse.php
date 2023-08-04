<?php

namespace Sunnyr\Company\Http\Services;

use Sunnyr\Company\Http\Services\PasswordResetService;
use Symfony\Component\HttpFoundation\Response;

class UserNotFoundResponse
{
    public function __construct(public $status)
    {
    }

    public function toResponse($request)
    {
        if($this->status == PasswordResetService::WRONG_NUMBER){
            // return redirect()->route('fortify.auth.password.phone.request')->withErrors(['fail' => PasswordResetService::WRONG_NUMBER]);

            return response([
                'status' => 'fail',
                'message' => 'شماره وارد شده اشتباه است!'
             ], Response::HTTP_BAD_REQUEST);
        }
        elseif($this->status == PasswordResetService::GENERAL_ERROR){
            // return redirect()->route('fortify.auth.password.phone.request')->withErrors(['fail' => PasswordResetService::GENERAL_ERROR]);

            return response([
               'status' => 'fail',
               'message' => 'خطایی در سمت سرور رخ داد'
             ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        }    
    }

