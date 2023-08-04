<?php

namespace Sunnyr\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sunnyr\Company\Database\Factories\ResumeFactory;

class Resume extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'attrs' =>  'array'
    ];

    protected static function newFactory()
    {
        return ResumeFactory::new();
    }
}
