<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Inertia\Testing\AssertableInertia;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserAsAgentTest extends TestCase
{
    use RefreshDatabase;

    public function test_inertia_component_loads_when_user_redirects_to_register_user_as_agent_page()
    {
        $user = User::factory(['username' => '09118694561'])->create();

        $response = $this->actingAs($user)->get(route('fortify.auth.register-user-as-agent'));
        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Auth/RegisterUserAsAgent'));
    }

    public function test_guest_users_can_not_visit_register_user_as_agent_page()
    {
        $response = $this->get(route('fortify.auth.register-user-as-agent'));
        $response->assertRedirect(route('login'));
    }

    public function test_users_which_are_not_agents_cant_visit_register_user_as_agent_page()
    {
        $user = User::factory(['username' => '09118694561'])->create();

        $response = $this->actingAs($user)->get(route('fortify.auth.register-user-as-agent'));
        $response->assertStatus(200);
    }

    public function test_agents_are_added_to_database()
    {
        $user = User::factory(['username' => '09118694561'])->create();

        $data = [
            'id'    => $user->id,
            'name'  => 'masoud',
            'lastname'  => 'seraj',
            'mobile'    =>  '09118694561',
            'company_number'    => '01732147200',
            'position'  => 'برنامه نویس',
            'description' => 'فیلد توضیحات سیبسبسشیبشسیب'
        ];

        $this->actingAs($user)->postJson(route('fortify.auth.register-user-as-agent.post', $data));
        $this->assertDatabaseHas('agents', ['company_number' => '01732147200', 'position' => 'برنامه نویس']);
    }

    // public function test_unregistered_users_can_
}
