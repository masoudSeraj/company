<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\OneTimeCode;
use Sunnyr\Company\Models\Agent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Sunnyr\Company\Events\AgentCreated;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Sunnyr\Company\Http\Services\CodeGeneratorService;
use Sunnyr\Company\Notifications\AgentCreatedNotification;

class AgentTest extends TestCase
{
    use RefreshDatabase;

    public function test_agent_factory_relationship_works_properly()
    {
        $user = User::factory()->has(
            Agent::factory()->isActive()
        )->create();

        $this->assertDatabaseHas('users', [
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name
        ]);

        $this->assertDatabaseHas('agents', [
            'user_id'           =>  $user->id,
            'company_number'    =>  $user->agent->company_number
        ]);
    }

    public function test_agent_is_successfully_created_after_user_is_registered()
    {
        $this->registerPath();
        $data = $this->registerData();
        
        $this->register($data);

        $this->assertDatabaseHas('users', [
            'first_name' =>  'masoud',
            'last_name'  =>  'seraj',
            'username'   =>  '09118694561',
        ]);

        $this->assertDatabaseHas('agents', [
            'company_number'    =>  '01732247200',
            'description'       =>  'company description',
            'position'          =>  'job title'
        ]);
    }

    public function test_user_is_not_created_if_same_username_is_entered_and_receives_invalid_error()
    {
        $this->registerPath();
        User::factory()->create(['username' => '09118694561']);

        $data = $this->registerData();
        $response = $this->register($data);

        $response->assertInvalid('username');
        $this->assertDatabaseCount('users', 1);
    }

    public function test_agent_created_event_is_dispatched_successfully_after_agent_is_registered()
    {
        Event::fake();

        $this->registerPath();
        $data = $this->registerData();
        $this->register($data);
        Event::assertDispatched(AgentCreated::class);
    }

    public function test_user_registered_event_is_not_dispatched_after_agent_is_registered()
    {
        Event::fake();

        $this->registerPath();
        $data = $this->registerData();
        $this->register($data);
        Event::assertNotDispatched(Registered::class);
    }

    public function test_notification_is_triggered_successfully_after_agent_is_registered()
    {
        $this->registerPath();
        $data = $this->registerData();
        $this->register($data);
        
        $agent = Agent::get()->first();

        Notification::assertSentTo(
            [$agent->user], AgentCreatedNotification::class
        );
    }

    public function test_user_is_logged_in_after_agent_is_registered()
    {     
        $this->registerPath();
        $data = $this->registerData();
        $this->register($data);
        
        $this->assertAuthenticated();
    }

    public function test_one_time_code_is_generated_for_specific_user()
    {
        $user = User::factory()->create();

        $mock = $this->createMock(CodeGeneratorService::class);
            $mock->method('generate')
            ->willReturn(22333);

        app()->instance(CodeGeneratorService::class, $mock);
        $this->get(route('fortify.auth.request.verification', ['id' => $user->id]));

        $this->assertDatabaseHas(app(OneTimeCode::class)->getTable(), ['user_id' => $user->id, 'code' => 22333]);
    }

    public function test_user_is_redirected_to_verification_page_if_not_verified()
    {
        $this->registerPath();
        $data = $this->registerData();
        $response = $this->register($data);

        $response->assertRedirect(route('fortify.auth.verification'));
    }

    public function test_invalid_code_will_result_in_error()
    {
        $this->registerPath();
        $data = $this->registerData();
        $response = $this->register($data);

        $data = ['code' => 12345, 'id' => 6];

        $response = $this->postJson(route('fortify.auth.submit.verification', $data));
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertNull(User::get()->first()->verified_at);
        $this->assertEquals(0, User::get()->first()->agent->is_active);
    }

    public function test_valid_code_will_verify_the_user()
    {
        $this->registerPath();
        $data = $this->registerData();
        $response = $this->register($data);
        
        OneTimeCode::create([
            'user_id'   =>  User::get()->first()->id,
            'code'      =>  12345
        ]);

        $data = ['code' => 12345, 'userId' => User::get()->first()->id];

        $this->assertDatabaseHas('one_time_codes', ['code' => 12345]);
        $response = $this->actingAs(User::get()->first())->post(route('fortify.auth.submit.verification', $data));

        $this->assertEquals(0, User::get()->first()->is_active);
        $this->assertNotNull(User::get()->first()->verified_at);
    }

    public function test_one_time_code_will_be_removed_after_successfully_entering_valid_code()
    {
        $this->registerPath();
        $data = $this->registerData();
        $response = $this->register($data);
        
        OneTimeCode::create([
            'user_id'   =>  User::get()->first()->id,
            'code'      =>  12345
        ]);

        $data = ['code' => 12345, 'userId' => User::get()->first()->id];

        $this->assertDatabaseHas('one_time_codes', ['code' => 12345]);
        $response = $this->actingAs(User::get()->first())->post(route('fortify.auth.submit.verification', $data));

        $this->assertDatabaseEmpty('one_time_codes');
    }

    public function test_valid_code_will_recieve_a_successful_message()
    {
        $this->registerPath();
        $data = $this->registerData();
        $response = $this->register($data);

        OneTimeCode::create([
            'user_id'   =>  User::get()->first()->id,
            'code'      =>  12345
        ]);

        $data = ['code' => 12345, 'userId' => User::get()->first()->id];
        $response = $this->actingAs(User::get()->first())->post(route('fortify.auth.submit.verification', $data));

        $response->assertStatus(Response::HTTP_ACCEPTED);
        $this->assertArrayHasKey('message', (array)json_decode($response->getContent()));
    }

    public function test_wrong_company_number_format_number_result_in_error()
    {
        $userData = [
            'name'      =>  'masoud',
            'lastname'  =>  'seraj',
            'username'  =>  '09118694561',
            'password'  =>  '$2y$10$PbCvxEpcMlVCOPvXSObPqemKn.dzoC/d4oBunZ.s3eZM1qfa9AdxS',
            'password_confirmation' => '$2y$10$PbCvxEpcMlVCOPvXSObPqemKn.dzoC/d4oBunZ.s3eZM1qfa9AdxS' //Aa123456
        ];

        $agentData = [
            'company_number'    =>  '32247200',
            'description'       =>  'company description',
            'position'          =>  'job title'
        ];

        $data = [...$userData, ...$agentData];

        $response = $this->post(route('fortify.auth.register', $data));
        $response->assertInvalid(['company_number']);
    }

    

    public function test_agent_description_validation_works_fine()
    {
        $userData = [
            'name'      =>  'masoud',
            'lastname'  =>  'seraj',
            'username'  =>  '09118694561',
            'password'  =>  '$2y$10$PbCvxEpcMlVCOPvXSObPqemKn.dzoC/d4oBunZ.s3eZM1qfa9AdxS',
            'password_confirmation' => '$2y$10$PbCvxEpcMlVCOPvXSObPqemKn.dzoC/d4oBunZ.s3eZM1qfa9AdxS' //Aa123456
        ];

        $agentData = [
            'company_number'    =>  '32247200',
            // 'description'       =>  'company description',
            'position'          =>  'job title'
        ];

        $data = [...$userData, ...$agentData];

        $response = $this->post(route('fortify.auth.register', $data));
        $response->assertInvalid(['description']);
    }



    protected function registerPath()
    {
        $response = $this->get(route('fortify.auth.register'));
        return $response->assertStatus(200);
    }

    protected function registerData() :array
    {
        $userData = [
            'name'      =>  'masoud',
            'lastname'  =>  'seraj',
            'username'  =>  '09118694561',
            'password'  =>  '$2y$10$PbCvxEpcMlVCOPvXSObPqemKn.dzoC/d4oBunZ.s3eZM1qfa9AdxS',
            'password_confirmation' => '$2y$10$PbCvxEpcMlVCOPvXSObPqemKn.dzoC/d4oBunZ.s3eZM1qfa9AdxS' //Aa123456
        ];

        $agentData = [
            'company_number'    =>  '01732247200',
            'description'       =>  'company description',
            'position'          =>  'job title'
        ];

       return [...$userData, ...$agentData];
    }

    protected function register($data)
    {
        return $this->post(route('fortify.auth.register', $data));
    }
}


