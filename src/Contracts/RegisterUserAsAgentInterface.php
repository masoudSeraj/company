<?php namespace Sunnyr\Company\Contracts;

use Illuminate\Http\Request;

interface RegisterUserAsAgentInterface
{
    public function index();

    public function store(Request $request);
}