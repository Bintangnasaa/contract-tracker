<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $stats = [
                'total' => Content::count(),
                'in_progress' => Content::whereIn('status', ['scripting', 'shooting', 'editing'])->count(),
                'idea' => Content::where('status', 'idea')->count(),
                'published' => Content::where('status', 'published')->count(),
            ];

            $allContents = Content::with(['campaign', 'tasks.user'])
                ->orderBy('deadline', 'asc')
                ->get();

            return view('dashboard', compact('stats', 'allContents'));
        }

        $myTasks = Task::with('content.campaign')
            ->where('user_id', $user->id)
            ->orderBy('is_done', 'asc')
            ->latest()
            ->get();

        return view('dashboard', compact('myTasks'));
    }
}