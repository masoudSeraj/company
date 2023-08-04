<?php

namespace Sunnyr\Company\Database\Factories;

use Sunnyr\Company\Models\CompanySlider;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanySliderFactory extends Factory
{
    protected $model = CompanySlider::class;

    public function definition()
    {
        return [
            'title'     =>  fake()->text(20),
            'subtitle'  =>  fake()->text(40),
            'alt'       =>  fake()->text(40),
            'link'      =>  rand(0, 1) ? fake()->url() : null 
        ];
    }
}
