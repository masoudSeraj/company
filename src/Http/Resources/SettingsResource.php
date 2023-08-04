<?php

namespace Sunnyr\Company\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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
            'address'  => $this->settings['address'],
            'description'  => $this->settings['description'],
            'phone'  => $this->settings['phone'],
            'working_hour'  => $this->settings['working_hour'],
            'logo'  => Storage::disk('company')->url($this->settings['logo']),
            'favicon'   => isset($this->settings['favicon']) ? Storage::disk('company')->url($this->settings['favicon']) : null,
            'copyright' =>  $this->settings['copyright-text'],
            'og'    => [
                'title' => isset($this->settings['og']['title']) ? $this->settings['og']['title'] : 'وب سایت سانیار لوب تک رانا',
                'type'  => isset($this->settings['og']['type']) ? $this->settings['og']['type'] : 'website',
                'description' => isset($this->settings['og']['description']) ? $this->settings['og']['description'] : 'عرضه کننده انواع روانکارهای صنعتی با ارائه حواله پالایشگاه',
                'url'   => isset($this->settings['og']['url']) ? $this->settings['og']['url'] : 'https://sunnyrlube.com',
                'image' => isset($this->settings['og']['image']) ? Storage::disk('company')->url($this->settings['og']['image']) : null
            ],
            'posts' => [
                'post-count'    =>  $this->settings['post-count'] ?? 10,
                'title-count'   =>  $this->settings['title-count'] ?? 8,
                'content-count' =>  $this->settings['content-count'] ?? 60,
                'card-size'     =>  $this->settings['card-size'] ?? '90%',
                'rounded-color' =>  $this->settings['rounded-color'] ?? '#fde100'
            ]
        ];
    }
}
