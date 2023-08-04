<?php

namespace Sunnyr\Company\Http\Services;

use Sunnyr\Company\Http\Resources\UserResource;
use Sunnyr\Company\Http\Services\UserActivationService;

class UserFoundResponse
{
    public function __construct(public $status, public UserActivationService $userActivationService)
    {
    }

    public function toResponse($request)
    {
        $user = $this->userActivationService->findUser($request->username);
        return [
            'user'  =>  new UserResource($user),
        ];
    }
}
