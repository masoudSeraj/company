<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use Sunnyr\Company\Models\CompanySlider;
use Sunnyr\Company\Models\CompanySliderType;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CompanySliderTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_slider_type_can_be_created()
    {
        CompanySlider::factory()->has(
            CompanySliderType::factory()->count(2)->state(['type' => 1])
        )->create(['title' => 'Fake Title']);

        $this->assertDatabaseHas('company_slider_types', ['type' => 1]);
    }

}
