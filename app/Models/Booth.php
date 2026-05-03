<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    use HasFactory;

    protected $fillable = ['location_description','publisher_id','hall_id'];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }
}