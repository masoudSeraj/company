<?php

namespace Sunnyr\Company\Http\Resources;

use Sunnyr\Company\Enums\Types;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;
use Sunnyr\Company\Http\Resources\CategoryResource;

class CompanySliderTypesResource extends JsonResource
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
            'image' =>  Storage::disk('company')->url($this->image),
            'type'  =>  $this->type->name,
        ];
    }
}
