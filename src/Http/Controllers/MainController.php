<?php

namespace Sunnyr\Company\Http\Controllers;

use Inertia\Inertia;
use Sunnyr\Company\Http\Controllers\Controller;
use Sunnyr\Company\Http\Services\MainPageService;

class MainController extends Controller
{
    public function __construct(public MainPageService $mainPageService)
    {
    }
    public function index()
    {
        return Inertia::render('Main/Index', [
            'sliders'   =>    $this->mainPageService->getSliders(),
            'resumes'   =>    $this->mainPageService->getResumes(),
            'posts'     =>    $this->mainPageService->getPosts(),
        ]);
    }
}
