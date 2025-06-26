<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'landmark_id',
        'user_id',
        'rating',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function landmark()
    {
        return $this->belongsTo(Landmark::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}