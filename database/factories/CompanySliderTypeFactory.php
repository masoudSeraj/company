<?php

namespace Sunnyr\Company\Database\Factories;

use Sunnyr\Company\Models\CompanySlider;
use Sunnyr\Company\Models\CompanySliderType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanySliderTypeFactory extends Factory
{
    protected $model = CompanySliderType::class;

    public function definition()
    {
        return [
            'company_slider_id' =>  CompanySlider::factory(),
            'type'  =>  rand(0, 4),
            'ratio' =>  fake()->text(10),
            'attrs'   =>  json_encode([
                fake()->text(7) => [
                    fake()->text(5),
                    fake()->text(6)
                ]
            ])
        ];
    }
}
