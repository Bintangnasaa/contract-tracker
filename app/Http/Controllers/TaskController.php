<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request, Content $content)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'task_name' => 'required|string|max:255',
        ]);

        $content->tasks()->create([
            'user_id' => $validated['user_id'],
            'task_name' => $validated['task_name'],
            'is_done' => false,
        ]);

        return back()->with('success', 'Task berhasil ditugaskan ke Crew!');
    }

    public function toggle(Task $task)
    {
        // Cegah crew mencentang task milik crew lain
        if (Auth::user()->role === 'crew' && $task->user_id !== Auth::id()) {
            abort(403, 'Kamu hanya bisa mengubah status task milikmu sendiri.');
        }

        $task->update(['is_done' => !$task->is_done]);

        return back()->with('success', 'Status task diperbarui!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Task berhasil dihapus!');
    }
}