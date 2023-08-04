<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\OneTimeCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Sunnyr\Company\Events\OneTimeCodeGeneratedEvent;
use Sunnyr\Company\Http\Services\CodeGeneratorService;
use Sunnyr\Company\Http\Services\UserActivationService;
use Sunnyr\Company\Jobs\OneTimeCodeRemoveAutomatically;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Sunnyr\Company\Notifications\OneTimeCodeGeneratedNotification;

class UserActivationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_throttle_middleware_for_submitting_verification_code_works_fine()
    {
        $this->registerPath();
        $data = $this->registerData();
        $response = $this->register($data);

        $response = $this->get(route('fortify.auth.request.verification', ['id' => User::get()->first()->id]));
        $response2 = $this->get(route('fortify.auth.request.verification', ['id' => User::get()->first()->id]));

        $response->assertOk();
        $response2->assertStatus(429);
    }

    public function test_generate_code_for_authenticated_user_works()
    {
        $user = User::factory()->state([
            'first_name' => 'masoud', 
            'last_name' => 'seraj', 
            'username' => '09118694561'
        ])->create();
        
        $mock = $this->createMock(CodeGeneratorService::class);
        $mock->method('generate')
        ->willReturn(22333);

        app()->instance(CodeGeneratorService::class, $mock);
        
        $response = $this->get(route('fortify.auth.request.verification', ['id' => $user->id, 'code' => 22333]));
        $response->assertOk();

        $this->assertDatabaseCount(OneTimeCode::class, 1);
    }
    
    public function test_generate_code_event_triggers_successfully()
    {
        Event::fake();

        $user = User::factory()->state([
            'first_name'    => 'masoud', 
            'last_name'     => 'seraj', 
            'username'      => '09118694561'
        ])->create();
        

        $this->get(route('fortify.auth.request.verification', ['id' => $user->id]));

        Event::assertDispatched(OneTimeCodeGeneratedEvent::class);
    }

    public function test_generated_code_is_sent_to_user_via_notification()
    {
        // Event::fake();
        // Notification::fake();

        $user = User::factory()->state([
                'username' => '09118694561',
                'first_name'    => 'masoud',
                'last_name' => 'seraj',
                'level' => 'admin'
        ])->create();

        $mock = $this->createMock(CodeGeneratorService::class);
        $mock->method('generate')
            ->willReturn(22333);
        
        app()->instance(CodeGeneratorService::class, $mock);

        $this->get(route('fortify.auth.request.verification', ['id' => $user->id]));

        Notification::assertSentTo($user, OneTimeCodeGeneratedNotification::class);
    }

    public function test_generated_code_notification_is_sent_to_admins_successfully()
    {
        Notification::fake();

        $this->registerPath();
        $data = $this->registerData();
        $this->register($data);

        User::get()->first()->update(['level' => 'admin']);
        $this->get(route('fortify.auth.request.verification', ['id' => User::get()->first()->id]));

        Notification::assertSentTo(
            [User::get()], OneTimeCodeGeneratedNotification::class
        );
    }

    public function test_genrated_code_is_added_to_remove_queue_to_get_deleted_after_two_minutes()
    {
        Queue::fake();

        $user = User::factory()->state([
            'first_name'    => 'masoud', 
            'last_name'     => 'seraj', 
            'username'      => '09118694561'
        ])->create();

        $this->get(route('fortify.auth.request.verification', ['id' => $user->id]));

        Queue::assertPushed(OneTimeCodeRemoveAutomatically::class);
    }

    public function test_user_activation_service_throws_model_not_found_exception_when_user_does_not_exist_when_trying_to_enter_their_phonenumber()
    {
        User::factory()->state(['username' => '09118694561'])->create();

        $this->assertThrows(
            fn() => (new UserActivationService(new CodeGeneratorService))->findUser('09118451212'),
            ModelNotFoundException::class );
    }

    public function test_user_is_redirected_to_verification_page_if_is_alerady_registered_but_not_verified()
    {
        $user = User::factory()->state(['username' => '09118694561', 'verified_at' => null])->create();

        $response = $this->actingAs($user)->get(route('fortify.auth.login'));
        $response->assertRedirect(route('fortify.auth.verification'));
    }

    public function test_user_is_redirected_to_verification_page_if_tries_to_login_and_is_alerady_registered_but_not_verified()
    {
        $user = User::factory()->state([
            'username' => '09118694561', 
            'verified_at' => null])->create();

        $data = [
            'username'  => '09118694561',
            'password'  => 'password'
        ];

        $response = $this->post(route('fortify.auth.submit-login', $data));

        $this->assertAuthenticated();
        $response->assertRedirect(route('fortify.auth.verification'));
        // dd($response->getContent());
        // $response = $this->;
        // $response = $this->
    }

    public function test_guest_can_see_login_page()
    {
        $response = $this->get(route('fortify.auth.login'));
        $response->assertStatus(200);
    }

    private function registerPath()
    {
        $response = $this->get(route('fortify.auth.register'));

        return $response->assertStatus(200);
    }

    private function registerData() :array
    {

        $userData = [
            'name'      => 'masoud',
            'lastname'  =>  'seraj',
            'username'  =>  '09118694561',
            'password'  =>  '$2y$10$PbCvxEpcMlVCOPvXSObPqemKn.dzoC/d4oBunZ.s3eZM1qfa9AdxS',
            'password_confirmation' => '$2y$10$PbCvxEpcMlVCOPvXSObPqemKn.dzoC/d4oBunZ.s3eZM1qfa9AdxS' //Aa123456
        ];

        $agentData = [
            'company_number'    => '01732247200',
            'description'       =>  'company description',
            'position'          =>  'job title'
        ];

       return [...$userData ,...$agentData];
    }

    private function register($data)
    {
        return $this->post(route('fortify.auth.register', $data));
    }
}
