<?php

namespace Sunnyr\Company\Models;

use Sunnyr\Company\Models\Agent;
use Sunnyr\Company\Models\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory;

    public function agents() :BelongsToMany
    {
        return $this->belongsToMany(Agent::class, 'agent_company');
    }

    public function request() :HasMany
    {
        return $this->hasMany(Request::class, 'company_id', 'id');
    }
}
