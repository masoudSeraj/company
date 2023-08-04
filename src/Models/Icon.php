<?php

namespace Sunnyr\Company\Models;

use Sunnyr\Company\Models\Social;
use Illuminate\Database\Eloquent\Model;
use Sunnyr\Company\Database\Factories\IconFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Icon extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return IconFactory::new();
    }

    public function social() :HasOne
    {
        return $this->hasOne(Social::class);
    }
}
