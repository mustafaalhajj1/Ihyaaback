<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FairEditionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'year'=>$this->year,
            'publishers'=>$this->whenLoaded('publishers')
        ];
    }
}