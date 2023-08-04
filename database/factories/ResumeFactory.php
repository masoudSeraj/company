<?php

namespace Sunnyr\Company\Database\Factories;

use Sunnyr\Company\Models\Resume;
use Illuminate\Support\Facades\Storage;
use Sunnyr\Company\Http\Services\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResumeFactory extends Factory
{
    protected $model = Resume::class;
    public function definition()
    {
        $generator = new Generator;

        return [
            'image' =>  $generator->randomImages(),
            'alt'   =>  fake()->text(rand(70, 99)),
            'title' =>  fake()->text(rand(70, 99)),
            'context'   => $generator->randomNullableText(),
            'short_description' => $generator->randomNullableText(),
            'description'   => $generator->randomNullableText(),
            'contact_info'  =>  $generator->randomNullableText(),
            'attrs'  =>  json_encode([
                            fake()->text(7) => [
                                fake()->text(5),
                                fake()->text(6)
                            ]
                        ])
        ];
    }
}
