<?php namespace Sunnyr\Company\Http\Services;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Sunnyr\Company\Rules\PasswordRule;
use Sunnyr\Company\Http\Resources\UserResource;
use Sunnyr\Company\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Sunnyr\Company\Http\Controllers\Authentication\Contracts\PasswordResetInterface;
use Sunnyr\Company\Http\Controllers\Authentication\Contracts\PasswordResetViewInterface;

class PasswordResetService implements PasswordResetInterface, PasswordResetViewInterface
{
    public const USER_FOUND = 'کاربر پیدا شد!';
    public const WRONG_NUMBER = 'شماره وارد شده در بین کاربران ما موجود نیست!';
    public const GENERAL_ERROR = 'خطایی رخ داد!';

    public function __construct(
        public UserActivationService $userActivationService, 
        public UserServiceInterface $userServiceInterface)
    {

    }

    public function view($userId)
    {
        $user = $this->userServiceInterface->getUser('id', $userId);
        auth()->login($user);

        return Inertia::render('Auth/ResetPasswordPhone', [
            'user'  => new UserResource($user)
        ]);
    }

    public function checkUser(array $credentials)
    {
        try{
            $this->userActivationService->findUser($credentials['username']);
        } catch(ModelNotFoundException $e){
            return static::WRONG_NUMBER;
        } catch(\Exception $e){
            return static::GENERAL_ERROR;
        }

        return static::USER_FOUND;
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'confirmed', new PasswordRule],
            'password_confirmation' => ['required', 'string']
        ]);

        $user = auth()->user();

        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();
    }
}

