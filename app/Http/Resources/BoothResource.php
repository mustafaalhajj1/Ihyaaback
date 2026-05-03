<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoothResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'location'=>$this->location_description,
            'publisher'=>$this->whenLoaded('publisher'),
            'hall'=>$this->whenLoaded('hall')
        ];
    }
}