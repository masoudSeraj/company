<?php

namespace Sunnyr\Company\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' =>  $this->first_name,
            'last_name' => $this->last_name,
            'username'  => $this->username,
            'email' => $this->email,
            'image' =>  $this->image ? Storage::disk('company')->url($this->image) : asset('empty.jpg'),
        ];
    }
}
