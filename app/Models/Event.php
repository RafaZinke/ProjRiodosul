<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'landmark_id',
        'title',
        'description',
        'event_date',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function landmark()
    {
        return $this->belongsTo(Landmark::class);
    }
}