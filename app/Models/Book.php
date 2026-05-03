<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','publication_year','language'];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function publishers()
    {
        return $this->belongsToMany(Publisher::class);
    }

    public function comments()
    {
        return $this->hasMany(BookComment::class);
    }

    public function ratings()
    {
        return $this->hasMany(BookRating::class);
    }
}