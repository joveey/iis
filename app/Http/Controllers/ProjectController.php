<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()->latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        auth()->user()->projects()->create($validated);

        return redirect()->route('projects.index')->with('success', 'Proyek baru berhasil dibuat!');
    }

    public function show(Project $project)
    {
        abort_if($project->user_id !== auth()->id(), 403);
        
        // Tandai notifikasi sebagai sudah dibaca jika ada parameter 'read'
        if (request()->has('read')) {
            auth()->user()->notifications->where('id', request('read'))->markAsRead();
        }

        $tasks = $project->tasks()->get()->groupBy('status');
        
        // Pastikan semua kolom status ada, meskipun kosong
        $columns = [
            'To Do' => $tasks->get('To Do', collect()),
            'In Progress' => $tasks->get('In Progress', collect()),
            'Done' => $tasks->get('Done', collect()),
        ];

        return view('projects.show', compact('project', 'columns'));
    }
}