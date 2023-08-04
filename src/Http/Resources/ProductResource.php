<?php

namespace Sunnyr\Company\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'categories'    => [
                'parent'    =>  $this?->parent,
                'children'  =>  $this?->categories,
            ],
            'short_description' => $this->short_description,
            'image'         =>  $this->image(),
            'meta_description'  =>  $this->meta_description,
            'meta_title'    =>  $this->meta_title,
            'slug'          =>  $this->slug,
            'url'           =>  route('filters.product.show', ['id' => $this->id]),
            $this->mergeWhen($request->routeIs('filters.product.show'), [
                'description' => $this->description,
                'gallery'       =>  $this->imageGallery(),
                'brand'         =>  $this?->brand->name ?? 'نامشخص',
            ]),
        ];
    }

    protected function image()
    {
        return $this->image ? Storage::disk('public')->url($this->image) : Storage::disk('public')->url('uploads/empty.jpg');
    }

    protected function imageGallery()
    {
        if($this->gallery()->exists()){
            $image = $this->gallery->map(fn($image) => Storage::disk('public')->url($image->image));
        }
        else{
            if($this->image){
                $image = [Storage::disk('public')->url($this->image)];
            }
            else{
                $image = [Storage::disk('public')->url('uploads/empty.jpg')];
            }
        }
        
        return $image;
    }
}
