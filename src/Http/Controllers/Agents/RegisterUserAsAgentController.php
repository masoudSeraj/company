<?php namespace Sunnyr\Company\Http\Controllers\Agents;

use Illuminate\Http\Request;
use App\Exceptions\UserAsAgentException;
use Sunnyr\Company\Http\Controllers\Controller;
use Sunnyr\Company\Contracts\RegisterUserAsAgentInterface;

class RegisterUserAsAgentController extends Controller
{
    public function __construct(public RegisterUserAsAgentInterface $registerUserAsAgent)
    {
        
    }

    public function index()
    {
        return $this->registerUserAsAgent->index();
    }

    public function store(Request $request)
    {
        try{
            $this->registerUserAsAgent->store($request);
            return response(['success' => 'اطلاعات شما با موفقیت ثبت شد!', 'redirect' => route('company.index')]);
        } catch(UserAsAgentException $e){
            return response(['error' => 'خطایی رخ داد'], 500);
        }
        
    }
}