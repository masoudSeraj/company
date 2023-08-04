<?php

namespace Sunnyr\Company\Tests\Unit;

use Sunnyr\Company\Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Sunnyr\Company\Http\Services\Generator;

class GeneratorTest extends TestCase
{
    // public function test_images_exist_in_storage()
    // {
    //     Storage::fake('company');

    //     UploadedFile::fake()->image('image7.jpg');
    //     UploadedFile::fake()->image('image8.png');
    //     UploadedFile::fake()->image('image9.png');

    //     dd(Storage::disk('company'));
    //     Storage::disk('company')->assertExists('image7.jpg');
    // }
        
    public function test_random_images_work()
    {
        Storage::fake('company');

        $generator = new Generator();

        $this->assertStringContainsString('https://via', $generator->randomImages());
    }

    // public function test_random_text_is_generated()
    // {
    //     $mock = $this->createMock(Generator::class);
    //     $mock->expects($this->once())
    //         ->method('boolRandom')
    //         ->willReturn(1);
    //     // $generator = new Generator();
    //     // dd($generator->randomText());
    //     dd($mock->randomText());
    // }

}
