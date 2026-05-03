<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'user'=>$this->whenLoaded('user'),
            'book'=>$this->whenLoaded('book')
        ];
    }
}