<?php

namespace Sunnyr\Company\Database\Factories;

use Sunnyr\Company\Models\Icon;
use Sunnyr\Company\Models\Resume;
use Sunnyr\Company\Models\Settings;
use Sunnyr\Company\Http\Services\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class IconFactory extends Factory
{
    protected $model = Icon::class;
    public function definition()
    {
        $generator = new Generator;

        return [
            'title' =>  $generator->randomText(),
            'code' =>  $generator->randomText(),
            'type'  =>  rand(0, 1),
            'is_active' =>  rand(0, 1)
        ];
    }
}
