<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task; // <-- Tambahkan ini

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil semua proyek milik user
        $projects = $user->projects()->get();
        $projectIds = $projects->pluck('id');

        // Menghitung statistik proyek
        $totalProjects = $projects->count();
        $activeProjects = $projects->where('status', 'In Progress')->count();
        $completedProjects = $projects->where('status', 'Completed')->count();

        // Menghitung statistik tugas
        $totalTasks = Task::whereIn('project_id', $projectIds)->count();
        
        // Mengambil 5 tugas terakhir dari semua proyek user
        $recentTasks = Task::whereIn('project_id', $projectIds)
                                        ->with('project:id,name') // Eager load relasi project
                                        ->latest()
                                        ->take(5)
                                        ->get();

        return view('dashboard', [
            'totalProjects' => $totalProjects,
            'activeProjects' => $activeProjects,
            'completedProjects' => $completedProjects,
            'totalTasks' => $totalTasks,
            'recentTasks' => $recentTasks,
        ]);
    }
}