<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        abort_if($project->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $project->tasks()->create($validated);

        return back()->with('success', 'Tugas baru berhasil ditambahkan.');
    }

    public function update(Request $request, Task $task)
    {
        abort_if($task->project->user_id !== auth()->id(), 403);
    
        $validated = $request->validate([
            'status' => 'required|string|in:To Do,In Progress,Done',
        ]);
    
        // Update status dan is_completed berdasarkan input
        $task->update([
            'status' => $validated['status'],
            'is_completed' => $validated['status'] === 'Done',
        ]);
    
        return back()->with('success', 'Status tugas berhasil diperbarui.');
    }

    public function destroy(Task $task)
    {
        abort_if($task->project->user_id !== auth()->id(), 403);

        $task->delete();

        return back()->with('success', 'Tugas berhasil dihapus.');
    }
}