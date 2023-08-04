<?php namespace Sunnyr\Company\Http\Controllers\Agents;

use Illuminate\Http\Request;


use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Sunnyr\Company\Rules\PasswordRule;
use Sunnyr\Company\Events\AgentCreated;
use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Sunnyr\Company\Http\Controllers\Controller;
use Laravel\Fortify\Contracts\RegisterViewResponse;
use Sunnyr\Company\Http\Services\Agent\AgentService;
use Sunnyr\Company\Http\Services\Agent\RegisterResponseService;

class RegisterAgentController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;
    protected $agentService;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard, AgentService $agentService)
    {
        $this->guard = $guard;
        $this->agentService = $agentService;
    }

    /**
     * Show the registration view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\RegisterViewResponse
     */
    public function create(Request $request): RegisterViewResponse
    {
        return app(RegisterViewResponse::class);
    }

    /**
     * Create a new registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\CreatesNewUsers  $creator
     * @return \Laravel\Fortify\Contracts\RegisterResponse
     */
    public function store(Request $request,
                          CreatesNewUsers $creator)
    {
        DB::transaction(function() use ($request, $creator) {
            $user = $creator->create(
                $request->only('name', 'lastname', 'username', 'password', 'password_confirmation')
            );
            
            event(new AgentCreated($this->agentService->setModel($user->agent())->store($request)));
            $this->guard->login($user);
            
            return app(RegisterResponseService::class)->toResponse($request);
        });
    }
}