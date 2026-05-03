<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventRatingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'rating'=>$this->rating,
            'user'=>$this->whenLoaded('user'),
            'event'=>$this->whenLoaded('event')
        ];
    }
}