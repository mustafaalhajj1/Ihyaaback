<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'date'=>$this->date,
            'time'=>$this->time,
            'hall'=>$this->whenLoaded('hall'),
            'authors'=>$this->whenLoaded('authors'),
            'bookings'=>$this->whenLoaded('bookings')
        ];
    }
}