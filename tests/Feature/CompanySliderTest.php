<?php

namespace Sunnyr\Company\Tests\Feature;

use Artisan;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Inertia\Testing\AssertableInertia;
use Sunnyr\Company\Models\CompanySlider;
use Sunnyr\Company\Models\CompanySliderType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Sequence;

class CompanySliderTest extends TestCase
{
    use RefreshDatabase;
    public function test_company_slider_can_be_created()
    {
        CompanySlider::factory()->create(['title' => 'Fake Title']);
        $this->assertDatabaseHas('company_sliders', ['title' => 'Fake Title']);
    }

    public function test_company_slider_seeder_works_fine()
    {
        CompanySlider::factory()
            ->count(2)
            ->state(new Sequence(
                ['title' => 'abc'],
                ['title' => 'efgh']
            ))->has(
            CompanySliderType::factory()->count(2)->state(
                new Sequence(fn(Sequence $sequence) =>
                    ['image' => 'image7.jpg', 'type' => 0],
                    ['image' => 'image8.png', 'type' => 1],
            )),
        )->create();
        
        $this->assertDatabaseHas('company_sliders', ['title' => 'abc']);
        $this->assertDatabaseHas('company_slider_types', ['image' => 'image7.jpg']);
        $this->assertDatabaseCount('company_slider_types', 4);
        $this->assertDatabaseCount('company_sliders', 2);
    }

    public function test_company_sliders_are_displayed_in_descending_order()
    {
        $slider1 = CompanySlider::factory()->state(['title' => 'title1'])->create();
        $slider2 = CompanySlider::factory()->state(['title' => 'title2'])->create();

        $response = $this->get(route('company.index'));
        $response->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Main/Index')
                ->where('sliders.data.0.title', $slider1->title)
                ->where('sliders.data.1.title', $slider2->title));
    }

    public function test_company_sliders_has_order_column()
    {
        Artisan::call('migrate');
        $result = Schema::hasColumn('company_sliders', 'order');
        $this->assertTrue($result);
        Artisan::call('migrate:rollback');
        $result = Schema::hasColumn('company_sliders', 'order');
        $this->assertFalse($result);
    }
}


