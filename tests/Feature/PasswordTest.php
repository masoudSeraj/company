<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use App\Models\User;

use App\Models\OneTimeCode;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_visit_password_reset_page()
    {
        $response = $this->get(route('fortify.auth.password.phone.request'));
        $response->assertStatus(200);
    }

    public function test_user_api_resource_is_returned_after_user_is_found()
    {
        $user = User::factory()->state(['username' => '09118694561'])->create();
        
        $response = $this->post(route('fortify.auth.password.phone', ['username' => $user->username]));

        $response->assertJsonPath('user.username', $user->username);
        $response->assertJsonCount(6, 'user');
    }


    public function test_throttle_middleware_for_submitting_phone_number_to_reset_password_works_fine()
    {
        User::factory()->state(['username' => '09118694561'])->create();

        $response1 = $this->post(route('fortify.auth.password.phone', ['username' => '0911869444']));
        $response2 = $this->post(route('fortify.auth.password.phone', ['username' => '09118456512']));
        $response3 = $this->post(route('fortify.auth.password.phone', ['username' => '09118456512']));
        $response4 = $this->post(route('fortify.auth.password.phone', ['username' => '09118456512']));
        $response5 = $this->post(route('fortify.auth.password.phone', ['username' => '09118456512']));

        $response5->assertStatus(429);

    }

    public function test_throttle_middleware_for_submitting_phone_number_to_reset_password_works_per_user_and_it_can_not_affect_others()
    {
        $user1 = User::factory()->state(['username' => '09118694561'])->create();

        $this->actingAs($user1)->postJson(route('fortify.auth.password.phone', ['username' => '0911869444']));
        $this->actingAs($user1)->postJson(route('fortify.auth.password.phone', ['username' => '09118456512']));
        $this->actingAs($user1)->postJson(route('fortify.auth.password.phone', ['username' => '09118456512']));
        $this->actingAs($user1)->postJson(route('fortify.auth.password.phone', ['username' => '09118456512']));
        $response1 = $this->actingAs($user1)->postJson(route('fortify.auth.password.phone', ['username' => '09118456512']));

        $response1->assertStatus(429);

        $user2 = User::factory()->state(['username' => '09118694560'])->create();
        $response2 = $this->actingAs($user2)->postJson(route('fortify.auth.password.phone', ['username' => '09118694643']));
        $response2->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_default_image_is_passed_when_the_user_image_is_empty_and_submits_phone_number_for_password_change()
    {
        Storage::fake();
        
        $user = User::factory()->state(['username' => '09118694561', 'image' => null])->create();
        $response = $this->post(route('fortify.auth.password.phone', ['username' => $user->username]));

        $imagePath = explode('/', $response['user']['image']);

        $this->assertStringContainsString('empty.jpg', $response['user']['image']);
        $this->assertSame('empty.jpg', end($imagePath));
    }

    public function test_response_has_error_when_the_phone_number_is_wrong()
    {
        User::factory()->state(['username' => '09118694561'])->create();

        $response = $this->post(route('fortify.auth.password.phone', ['username' => '09112753206']));

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson(['status' => 'fail']);
    }

    public function test_code_is_not_generated_when_the_phone_number_is_wrong()
    {
        User::factory()->state(['username' => '09118694561'])->create();
        $this->post(route('fortify.auth.password.phone', ['username' => '09112753206']));

        $this->assertDataBaseCount(app(OneTimeCode::class)->getTable(), 0);
    }

    public function test_user_is_authenticated_when_redirected_to_reset_password_page()
    {
        $user = User::factory()->state(['username' => '09118694561'])->create();
        $response = $this->get(route('fortify.auth.password.phone.reset', ['userId' => $user->id]));
        $response->assertStatus(200);
        $this->assertAuthenticated();
    }

    public function test_user_details_is_returned_when_redirected_to_reset_password_page()
    {
        $user = User::factory()->state(['username' => '09118694561'])->create();
        $response = $this->get(route('fortify.auth.password.phone.reset', ['userId' => $user->id]));

        $response->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Auth/ResetPasswordPhone')
                ->has('user')
                ->has('user.data')
                ->has('user.data', 6)
                ->where('user.data.username', $user->username));
    }

    public function test_user_can_reset_password()
    {
        $user = User::factory()->state(['username' => '09118694561'])->create();
        $data = [
            'password' => 'Aa123456',
            'password_confirmation' => 'Aa123456',
        ];

        $response = $this->actingAs($user)->post(route('fortify.auth.password.phone.reset.apply', $data));
        $response->assertStatus(200);

        $same = Hash::check('Aa123456', $user->password);
        $this->assertTrue($same);
    }

    public function test_password_confirmation_sends_error_when_they_are_not_same()
    {
        $user = User::factory()->state(['username' => '09118694561'])->create();
        $data = [
            'password' => 'Aa123456',
            'password_confirmation' => 'dddddddd',
        ];

        $response = $this->actingAs($user)->post(route('fortify.auth.password.phone.reset.apply', $data));
        $response->assertInvalid(['password']);
        $response->assertSessionHasErrors('password');
    }

    public function test_password_characters_length_cannot_be_less_than_8_characters(){
        $user = User::factory()->state(['username' => '09118694561'])->create();
        $data = [
            'password' => 'aaa',
            'password_confirmation' => 'aaa',
        ];

        $response = $this->actingAs($user)->post(route('fortify.auth.password.phone.reset.apply', $data));
        $response->assertInvalid(['password']);
        $response->assertSessionHasErrors('password');
    }
}