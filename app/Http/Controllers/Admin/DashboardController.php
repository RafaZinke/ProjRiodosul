<?php

// File: app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Landmark;
use App\Models\Event;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Exibe o painel administrativo com contagens de recursos.
     */
    public function index()
    {
        $landmarksCount  = Landmark::count();
        $eventsCount     = Event::count();
        $commentsCount   = Comment::count();
        $usersCount      = User::count();

        return view('admin.dashboard', compact(
            'landmarksCount',
            'eventsCount',
            'commentsCount',
            'usersCount'
        ));
    }
}
