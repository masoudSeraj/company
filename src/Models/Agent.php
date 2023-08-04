<?php

namespace Sunnyr\Company\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function companies() :BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'agent_company');
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
