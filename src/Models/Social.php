<?php

namespace Sunnyr\Company\Models;

use Sunnyr\Company\Models\Icon;
use Illuminate\Database\Eloquent\Model;
use Sunnyr\Company\Database\Factories\SocialFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sunnyr\Company\Database\Factories\SettingsFactory;

class Social extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return SocialFactory::new();
    }

    public function icon() :BelongsTo
    {
        return $this->belongsTo(Icon::class);
    }
}
