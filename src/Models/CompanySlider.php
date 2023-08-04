<?php

namespace Sunnyr\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sunnyr\Company\Database\Factories\CompanySliderFactory;

class CompanySlider extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return CompanySliderFactory::new();
    }
    public function companySliderTypes(): HasMany
    {
        return $this->hasMany(CompanySliderType::class, 'company_slider_id');
    }
}
