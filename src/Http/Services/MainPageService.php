<?php namespace Sunnyr\Company\Http\Services;

use App\Models\Post;
use Sunnyr\Company\Models\Resume;
use Sunnyr\Company\Models\CompanySlider;
use Sunnyr\Company\Http\Resources\PostResource;
use Sunnyr\Company\Http\Resources\ResumeResource;
use Sunnyr\Company\Http\Resources\SettingsResource;
use Sunnyr\Company\Http\Resources\CompanySliderResource;

class MainPageService
{
    public function __construct(public SettingsService $settingsService)
    {

    }
    public function getSliders()
    {
        return CompanySliderResource::collection(CompanySlider::orderBy('created_at', 'DESC')->get());
    }

    public function getResumes()
    {
        return ResumeResource::collection(Resume::all());
    }

    public function getPosts()
    {       
        return PostResource::collection(Post::with('comments')->withCount('comments')->latest()->take($this->settingsService->postsToDisaplay())->get());
    }

    // public function getCurrent
    //public function getSettings()
    //{
    //    return SettingsResource::collection(Settings::where('is_active', 1)->get());
    //}
}

