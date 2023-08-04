<?php

namespace Sunnyr\Company\Database\Factories;

use Sunnyr\Company\Models\Agent;
use Sunnyr\Company\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name'      =>  fake()->company(),
            'number'    =>  function (array $attributes) {
                return Agent::find($attributes['agent_id'])->company_number;
            },

            'description'   =>  rand(0, 1) ?? fake()->paragraphs(6),
            'address'       =>  rand(0, 1) ?? fake()->address(),
        ];
    }

    public function isActive() :Factory
    {
        return $this->state(function(array $attributes){
            return [
                'is_active' => 1
            ];
        }); 
    }
}
