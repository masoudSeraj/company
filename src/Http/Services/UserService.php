<?php namespace Sunnyr\Company\Http\Services;

use Throwable;
use App\Models\User;
use Sunnyr\Company\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserService implements UserServiceInterface
{
    public function getUser($field = 'id', $value) : User|Throwable
    {
        $user = User::where($field, '=', $value)->first();

        if (!$user){
            throw new ModelNotFoundException();
        }
        
        return $user;
    }
}

