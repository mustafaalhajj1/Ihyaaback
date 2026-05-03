<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function booths()
    {
        return $this->hasMany(Booth::class);
    }
}