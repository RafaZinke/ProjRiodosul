<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'title',
        'event_date',
        'description',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
