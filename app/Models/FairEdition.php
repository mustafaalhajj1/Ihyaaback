<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FairEdition extends Model
{
    use HasFactory;

    protected $fillable = ['name','year'];

    public function publishers()
    {
        return $this->belongsToMany(Publisher::class);
    }
}