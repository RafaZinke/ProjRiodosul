<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'landmark_id',
        'user_id',
        'content',
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