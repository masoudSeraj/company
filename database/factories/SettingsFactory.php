<?php

namespace Sunnyr\Company\Database\Factories;

use Sunnyr\Company\Models\Resume;
use Sunnyr\Company\Models\Settings;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingsFactory extends Factory
{
    protected $model = Settings::class;
    public function definition()
    {

        return [
            'settings'  =>  json_encode([
                            'setting1' => [
                                    
                                    'is_active' =>  1

                            ],
                            
                            'setting2' => [
                                fake()->text(5),
                                fake()->text(rand(5, 10))
                            ]
                        ]),
        ];
    }
}
