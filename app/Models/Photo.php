<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'landmark_id',
        'url',
        'caption',
    ];

    public function landmark()
    {
        return $this->belongsTo(Landmark::class);
    }
}