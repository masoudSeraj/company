<?php namespace Sunnyr\Company\Contracts;

use Illuminate\Http\Request;

interface ContactusServiceInterface
{
    public function index();

    public function store(Request $request);
}