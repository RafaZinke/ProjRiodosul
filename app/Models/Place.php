<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    // Campos que podem ser atribuídos em mass-assignment
    protected $fillable = [
        'name',
        'description',
        'address',
        'latitude',
        'longitude',
    ];

    // Relacionamentos
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // Média de avaliações
    public function averageRating()
    {
        return round($this->ratings()->avg('score'), 1);
    }
}
