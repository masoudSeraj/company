<?php

namespace Sunnyr\Company\Database\Factories;

use Sunnyr\Company\Models\Icon;
use Sunnyr\Company\Http\Services\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactusFactory extends Factory
{
    protected $model = Icon::class;
    public function definition()
    {
        $generator = new Generator;

        return [
            'name' =>  $generator->randomText(),
            'email' =>  rand(0, 1) ? fake()->unique()->email() : null,
            'mobile'  =>  rand(0, 1) ? fake()->unique()->phoneNumber() : null, 
            'title' =>  rand(0, 1) ? fake()->text(100) : null,
            'message'   => fake()->paragraph()
        ];
    }
}
