<?php

namespace Sunnyr\Company\Database\Factories;

use Sunnyr\Company\Models\Icon;
use Sunnyr\Company\Models\Social;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialFactory extends Factory
{
    protected $model = Social::class;
    public function definition()
    {
        return [
            'icon_id'   =>  Icon::factory(),
            'link'      =>  fake()->url(),
            'description'   =>  fake()->paragraph(1),
            'is_active'     =>  rand(0, 1)
        ];
    }
}
