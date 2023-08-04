<?php

namespace Sunnyr\Company\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id' =>  $this->id,
            'title' => $this->title,
            'image'     => $this->image ? asset(Storage::url($this->image)) : asset(Storage::url('uploads/empty.jpg')),
            'backgroundImage'   =>  $this->background_image ? asset(Storage::url($this->background_image)) : asset(Storage::url('uploads/empty.jpg')),
            'meta_title'    =>  $this->meta_title,
            'meta_description'  =>  $this->meta_description,
            'products_count'    =>  $this->products()?->whereHas('reservationAvailable')->count()
        ];
    }
}
