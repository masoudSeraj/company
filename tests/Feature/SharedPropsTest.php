<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Sunnyr\Company\Models\Agent;
use Inertia\Testing\AssertableInertia;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SharedPropsTest extends TestCase
{
    use RefreshDatabase;

    public function test_isVerifiedUser_attr_is_passed_as_shared_prop_to_pages_and_is_false_if_user_not_authenticated()
    {
        $response = $this->get(route('company.index'));
        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->has('auth.isVerifiedUser')
            ->where('auth.isVerifiedUser', false));
    }

    public function test_isVerifiedUser_attr_is_passed_as_shared_prop_to_pages_and_is_false_if_verifed_is_null()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('company.index'));
        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->has('auth.isVerifiedUser')
            ->where('auth.isVerifiedUser', false));
    }

    public function test_is_verified_attr_is_passed_as_shared_prop_to_pages_and_is_true_if_is_verified_is_set_to_1()
    {
        $user = User::factory()->state(['verified_at' => now()])->has(Agent::factory())->create();

        $response = $this->actingAs($user)->get(route('company.index'));

        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->has('auth.isVerifiedUser')
            ->where('auth.isVerifiedUser', true));
    }
}
