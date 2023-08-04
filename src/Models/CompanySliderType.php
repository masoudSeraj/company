<?php

namespace Sunnyr\Company\Models;

use Sunnyr\Company\Enums\Types;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sunnyr\Company\Database\Factories\CompanySliderTypeFactory;

class CompanySliderType extends Model
{
  use HasFactory;
  protected $guarded = [];

  protected $casts = [
    'attrs' =>  'array',
    'type' => Types::class
  ];

  protected static function newFactory()
  {
      return CompanySliderTypeFactory::new();
  }

  public function companySlider() :BelongsTo
  {
    return $this->belongsTo(CompanySlider::class, 'company_slider_id');
  }
}
