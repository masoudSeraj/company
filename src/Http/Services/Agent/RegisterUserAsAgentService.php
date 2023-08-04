<?php namespace Sunnyr\Company\Http\Services\Agent;

use Error;
use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Sunnyr\Company\Models\Agent;
use App\Exceptions\UserAsAgentException;
use Illuminate\Support\Facades\Validator;
use Sunnyr\Company\Contracts\RegisterUserAsAgentInterface;

class RegisterUserAsAgentService implements RegisterUserAsAgentInterface
{
    public function index()
    {
        return Inertia::render('Auth/RegisterUserAsAgent');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'position' => $request->position,
                'company_number' => $request->company_number,
                'description' => $request->description,
                'company_name'  => $request->company_name
            ],
            [
                'company_name'  =>  ['required'],
                'position' => ['required', 'string', 'max:255', 'min:5'],
                'company_number'  => ['required', 'max:13', 'min:4', 'regex:/^0\d{2}-?\d{7,10}$/'],
                'description' => ['required', 'max:2000']
            ]);

        $validator->setAttributeNames(
            [
                'position' => 'پست سازمانی',
                'company_number' => 'شماره تماس سازمانی',
                'description' => 'توضیحات',
                'company_name' => 'نام سازمان'
            ]
        );

        $validator->validate();

        try{
            $agent = Agent::create([
                'user_id'    => $request->id,
                'position'  => $request->position,
                'company_number' => $request->company_number,
                'company_name' => $request->company_name,
                'description' => $request->description
            ]);
        } catch(\Exception $e) {
            throw new UserAsAgentException;
        }

        return $agent;
    }


}

