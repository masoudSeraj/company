<?php

namespace Sunnyr\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sunnyr\Company\Database\Factories\SettingsFactory;

class Settings extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'settings';

    protected $casts = [
        'settings' =>  'array'
    ];

    protected static function newFactory()
    {
        return SettingsFactory::new();
    }
}
