<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use Sunnyr\Company\Models\Resume;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResumeTest extends TestCase
{
    use RefreshDatabase;
    public function test_resume_seeder_works_fine()
    {
        Storage::fake('company');
        $resume = Resume::factory()->count(5)->state(['image' => 'image9.png'])->create();
        $this->assertDatabaseHas('resumes', ['image' => 'image9.png', 'alt' => $resume[0]->alt]);
    }
}
