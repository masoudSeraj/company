<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use Sunnyr\Company\Models\Icon;
use Sunnyr\Company\Models\Resume;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IconTest extends TestCase
{
    use RefreshDatabase;
    public function test_resume_seeder_works_fine()
    {
        Icon::factory()->count(3)->create();

        $this->assertDatabaseCount('icons', 3);
    }

    
}
