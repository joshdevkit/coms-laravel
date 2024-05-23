<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ProjectList;
use App\Models\TaskList;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user()->id;
        $projects = ProjectList::where('manager_id', $user)->with('tasks')->get();
        $projectCount = ProjectList::where('manager_id', $user)->first();

        foreach ($projects as $project) {
            $project->totalPercentage = $project->tasks->sum('percentage');
            $project->totalTasks = $project->tasks->count();
        }

        $totalProjects = $projects->count();
        $task = 0; // Initialize task count to 0

        if ($projectCount) {
            $task = TaskList::where('project_id', '=', $projectCount->id)->count();
        }

        return view('manager.dashboard', compact('projects', 'totalProjects', 'task'));
    }
}
