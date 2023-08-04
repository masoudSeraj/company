<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use Sunnyr\Company\Models\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;
    public function test_settings_seeder_works_fine()
    {
        Settings::factory()->count(3)->create();

        $this->assertDatabaseCount('settings', 3);
    }
}
