<?php namespace Sunnyr\Company\Http\Services;

use Illuminate\Support\Facades\Storage;

class Generator
{
    protected $images = ['image7.jpg', 'image8.png', 'image9.png'];
    protected $minSize = 100;
    protected $maxSize = 200;
    protected static $diskName = 'company';
    protected $randomBool = 1;

    public function checkImages() :bool
    {
        return collect($this->images)->every(function($image){
            Storage::disk(self::$diskName)->exists($image);
        });
    }
    public function take() :string
    {
        return collect($this->images)->random(1)->pop();
    }
    public function takeFromPlaceholderSite()
    {
        return fake()->imageUrl(480, 640, 'animals', true);
    }

    public function randomImages()
    {
        return $this->checkImages() ? $this->take() : $this->takeFromPlaceholderSite();
    }

    public function randomNullableText(?int $size=null)
    {
        return $this->boolRandom() ? fake()->text($size ?? rand($this->minSize, $this->maxSize)) : null;
    }

    public function randomText(?int $size=null)
    {
        return fake()->text($size ?? rand($this->minSize, $this->maxSize));
    }

    // public function randomGenerator(?int $size=null, $faker)
    // {
    //     return 
    // }

    public function setDiskName($diskName)
    {
        self::$diskName = $diskName;
    }

    public function boolRandom() :int
    {
        return $this->randomBool = rand(0, 1);
    }
}
