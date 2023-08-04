<?php

namespace Sunnyr\Company\Database\Factories;

use App\Models\User;
use Sunnyr\Company\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class AgentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agent::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'   =>  User::factory(),
            'company_number'    =>  fake()->phoneNumber(),
            'description'  => rand(0,1) ?? fake()->paragraph(5),
            'company_name' => fake()->company(),
            'position'      =>  fake()->jobTitle()
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
