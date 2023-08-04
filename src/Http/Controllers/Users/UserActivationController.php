<?php namespace Sunnyr\Company\Http\Controllers\Users;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Sunnyr\Company\Http\Controllers\Controller;
use Sunnyr\Company\Exceptions\OneTimeCodeNotValid;
use Sunnyr\Company\Http\Services\UserActivationService;

class UserActivationController extends Controller
{
    public $userActivationService;
    
    public function __construct(UserActivationService $userActivationService)
    {
        $this->userActivationService = $userActivationService;
    }

    public function create()
    {
        return Inertia::render('Auth/VerifyPhone');
    }
    
    public function generateCode($userId)
    {
        $this->userActivationService->generateCode($userId);

        return response([
            'message' =>    'کد تایید با موفقیت به موبایل شما ارسال شد'
        ], Response::HTTP_OK);
    }
    
    public function submit(Request $request)
    {
        try{
            $this->userActivationService->submit($request->code, $request->userId);
            return response(['message'=>'کد وارد شده صحیح بود'], Response::HTTP_ACCEPTED);
        } catch(OneTimeCodeNotValid $exception){
            return response(['message' => 'کد اشتباه است. دوباره تلاش کنید!'], Response::HTTP_BAD_REQUEST);
        }
    }
}
