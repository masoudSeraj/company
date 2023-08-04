<?php namespace Sunnyr\Company\Http\Services;

use Throwable;
use App\Models\User;
use App\Models\OneTimeCode;
use Sunnyr\Company\Exceptions\OneTimeCodeNotValid;
use Sunnyr\Company\Events\OneTimeCodeGeneratedEvent;
use Sunnyr\Company\Jobs\OneTimeCodeRemoveAutomatically;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserActivationService
{
    public function __construct(public CodeGeneratorService $codeGeneratorService)
    {

    }

    public function findUser($phoneNumber) : User|Throwable
    {
        $user = User::where('username', $phoneNumber)?->first();
        if(is_null($user)){
            throw new ModelNotFoundException;
        }

        return $user;
    }

    public function generateCode($userId)
    {
        $randomCode = $this->codeGeneratorService->generate();
        if(OneTimeCode::where('code', $randomCode)->exists()){
            return $this->generateCode($userId);
        }

        $oneTimeCode = OneTimeCode::create([
            'user_id'   =>  $userId,
            'code'      =>  $randomCode
        ]);
        // dd($userId);
        event(new OneTimeCodeGeneratedEvent($oneTimeCode, $userId));
        OneTimeCodeRemoveAutomatically::dispatch($oneTimeCode, $userId)->delay(now()->addMinutes(2));
    }

    public function submit(int $code, $userId) :User
    {
        $oneTimeCode = OneTimeCode::where('code', $code)->where('user_id', $userId);

        if(!$oneTimeCode->exists()){
            throw new OneTimeCodeNotValid;
        }

        $oneTimeCode->delete();

        $user = User::find($userId);
        $user->verified_at = now();
        $user->save();
        return $user;
    }
}

