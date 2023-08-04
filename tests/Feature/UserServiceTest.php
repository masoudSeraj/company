<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use App\Models\User;

use Sunnyr\Company\Http\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;
  
    public function test_getUser_function_returns_user_model_as_intended_if_pass_id_as_field()
    {
        $user = User::factory()->state([
            'first_name' => 'masoud',
            'last_name' => 'seraj',
            'username' => '09118694561'
            ])->create();

        $modelUser = app(UserService::class)->getUser('id', $user->id);

        $this->assertInstanceOf(User::class, $modelUser);
        $this->assertEquals($user->id, $modelUser->id);
    }

    public function test_getUser_function_returns_user_model_as_intended_if_pass_username_as_field()
    {
        $user = User::factory()->state([
            'first_name' => 'masoud',
            'last_name' => 'seraj',
            'username' => '09118694561'
            ])->create();

        $modelUser = app(UserService::class)->getUser('username', $user->username);

        $this->assertInstanceOf(User::class, $modelUser);
        $this->assertEquals($user->id, $modelUser->id);
    }

    public function test_getUser_will_throw_model_not_found_exception_when_user_is_not_found()
    {
        $user = User::factory()->state([
            'first_name' => 'masoud',
            'last_name' => 'seraj',
            'username' => '09118694561'
            ])->create();

        $this->assertThrows(
            fn()=> app(UserService::class)->getUser('username', '09118694545'),
            ModelNotFoundException::class
        );
    }
}
