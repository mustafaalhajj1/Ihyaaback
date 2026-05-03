<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventCommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'comment'=>$this->comment,
            'user'=>$this->whenLoaded('user'),
            'event'=>$this->whenLoaded('event')
        ];
    }
}