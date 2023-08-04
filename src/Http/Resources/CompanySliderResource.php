<?php

namespace Sunnyr\Company\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;
use Sunnyr\Company\Http\Resources\CategoryResource;
use Sunnyr\Company\Http\Resources\CompanySliderTypesResource;

class CompanySliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    =>  $this->id,
            'title' =>  $this->title,
            'subtitle'  =>  $this->subtitle,
            'alt'   =>  $this->alt,
            'images'    =>  CompanySliderTypesResource::collection($this->companySliderTypes),
            'link'  =>  $this->link,
        ];
    }
}
