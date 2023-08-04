<?php

namespace Sunnyr\Company\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'image' =>  $this->image ? asset('/storage' . $this->image) : Storage::disk('company')->url(config('company.empty')),
            'view'  =>  $this->view,
            'url'   =>  url('/shop/posts', ['post' => $this->slug]),
            'summary'   =>  $this->summary,
            'meta_description'  =>  $this->meta_description,
            'meta_title'    =>  $this->meta_title,
            'publish_date'  =>  $this->publish_date,
            'comments'  => $this->whenLoaded('comments'),
            'comments_count'    =>  $this->whenCounted('comments')
        ];
    }
}
