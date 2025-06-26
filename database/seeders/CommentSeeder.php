<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        // Cria 50 comentários
        Comment::factory()->count(50)->create();
    }
}