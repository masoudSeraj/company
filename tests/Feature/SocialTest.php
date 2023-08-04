<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use Sunnyr\Company\Models\Icon;
use Sunnyr\Company\Models\Resume;
use Sunnyr\Company\Models\Social;
use Sunnyr\Company\Models\Settings;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SocialTest extends TestCase
{
    use RefreshDatabase;
    public function test_socials_seeder_works_fine()
    {
        Icon::factory()->has(Social::factory())->create();

        $this->assertDatabaseCount('socials', 1);
        $this->assertDatabaseCount('icons', 1);
    }
}
