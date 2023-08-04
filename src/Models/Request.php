<?php

namespace Sunnyr\Company\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Request extends Model
{
    use HasFactory;

    public function company() :BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function products() :HasMany
    {
        return $this->hasMany(Product::class);
    }
}
