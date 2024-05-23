<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectList;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $totalProjects = ProjectList::count();
        $projects = ProjectList::with('tasks')->get()->all();
        foreach ($projects as $project) {
            $project->totalPercentage = $project->tasks->sum('percentage');
           $project->totalTasks = $project->tasks->count();
        }

        $allTasks = TaskList::count();

        return view('admin.dashboard', compact('totalProjects', 'projects', 'allTasks'));
    }
}
