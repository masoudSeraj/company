<?php

namespace Sunnyr\Company\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'title' => $this->name,
            'image' =>  $this->image,
            'description'   =>  $this->description,
            'products_count'    =>  $this->products->count()
        ];
    }
}
