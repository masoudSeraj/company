<?php namespace Sunnyr\Company\Http\Services\Agent;

use Sunnyr\Company\Models\Agent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AgentService
{
    protected $model = Agent::class;

    public function setModel(HasOne $model) :static
    {
        $this->model = $model;
        return $this;
    }

    public function store($request) :Agent
    {
        $validator = Validator::make([
            'company_number' => $request->company_number,
            'position' => $request->position,
            'description' =>   $request->description,
            'company_name'  => $request->company_name
        ],
        [
            'company_name'  =>  ['required'],
            'company_number'    => ['required', 'max:13', 'min:4', 'regex:/^(0\d{2}-?)?\d{7,10}$/'], //017-32147200 or 01732147200 or 32147200
            'position' => [
                'required', 'string', 'max:255', 'min:5'
            ],
            'description' => ['required', 'max:2000']
        ]);

        $validator->setAttributeNames(['company_number' => 'شماره تماس سازمان', 'position' => 'پست سازمانی', 'company_name' => 'نام سازمان']);

        $validator->validate();

        return $this->model->create([            
            'company_number' => $request->company_number,
            'company_name'  => $request->company_name,
            'position'       =>   $request->position,
            'description'    => $request->description
        ]);        
    }
}

