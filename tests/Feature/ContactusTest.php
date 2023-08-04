<?php

namespace Sunnyr\Company\Tests\Feature;

use Artisan;
use Tests\TestCase;
use App\Models\User;
use Inertia\Testing\AssertableInertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Sunnyr\Company\Http\Services\ContactusService;
use Sunnyr\Company\Contracts\ContactusServiceInterface;

class ContactusTest extends TestCase
{
    use RefreshDatabase;

    // public function test_contactus_migration_is_added_to_list_of_migrations_when_publishing_it()
    // {
    //     Artisan::call('vendor:publish', ['--tag' => 'company-contactus']);
    //     $files =  array_values(array_diff(scandir(database_path('migrations')), array(".", "..")));

    //     $this->assertStringContainsString('create_contactus_table', array_pop($files));

    //     //remove the migration
    //     $files =  array_values(array_diff(scandir(database_path('migrations')), array(".", "..")));

    //     if(str_contains($popped = array_pop($files), 'create_contactus_table')){
    //         unlink(database_path('migrations\\' . $popped));
    //     }
    // }

    public function test_user_can_access_contact_us_page()
    {
        $response = $this->get(route('contact-us.index'));
        $response->assertStatus(200);
        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Contactus/ContactusIndex'));
    }

    public function test_logged_in_user_can_add_contactus()
    {
        $user = User::factory()->state(['username' => '09118694561'])->create();
        $data = [
            'mobile' => '09118694561',
            'name'  => 'masoud seraj',
            'title' => fake()->text(50),
            'message'   => fake()->paragraph(),
            'userId' => $user->id
        ];
        
        $response = $this->actingAs($user)->postJson(route('contact-us.store', $data));
        $response->assertStatus(200);

        $this->assertDatabaseHas('contactuses', ['user_id' => $user->id, 'mobile' => $user->username]);
    }

    public function test_exception_thrown_can_be_controlled_in_controller_and_return_an_error_for_user()
    {
        $user = User::factory()->state(['username' => '09118694561'])->create();
        $data = [
            'mobile' => '09118694561',
            'name'  => 'masoud seraj',
            'title' => fake()->text(50),
            'message'   => fake()->paragraph(),
            'userId' => $user->id
        ];
        
        $mock = $this->createMock(ContactusService::class)
            ->method('store')
            ->will($this->throwException(
                new \Illuminate\Database\Eloquent\ModelNotFoundException()
            ));
            
        $this->instance(ContactusService::class, $mock);
        $response = $this->actingAs($user)->postJson(route('contact-us.store', $data));
        $response->assertStatus(500);
    }

    public function test_validation_exception_thrown_can_be_controlled_in_controller_and_return_an_error_for_user()
    {
        $user = User::factory()->state(['username' => '09118694561'])->create();
        $data = [
            'mobile' => '09118694561',
            'name'  => 'masoud seraj',
            'title' => fake()->text(50),
            'message'   => null,
            'userId' => $user->id
        ];

        $response = $this->actingAs($user)->postJson(route('contact-us.store', $data));
        $response->assertStatus(422);
    }

}
