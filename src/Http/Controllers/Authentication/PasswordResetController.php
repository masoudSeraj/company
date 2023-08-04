<?php

namespace Sunnyr\Company\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Sunnyr\Company\Http\Controllers\Authentication\Contracts\PasswordResetInterface;
use Sunnyr\Company\Http\Controllers\Authentication\Contracts\PasswordResetViewInterface;

class PasswordResetController extends Controller
{
    public function __construct(
        public PasswordResetInterface $passwordResetInterface, 
        public PasswordResetViewInterface $passwordResetViewInterface)
    {

    }

    public function create($userId)
    {
        return $this->passwordResetViewInterface->view($userId);
    }

    public function store(Request $request)
    {
        $this->passwordResetInterface->reset($request);
    }   
}
