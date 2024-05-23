<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\ProjectList;
use App\Models\TaskList;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user()->id;
        $projects = ProjectList::where('project_owner', $user)->with('tasks')->get();
        $projectCount = ProjectList::where('project_owner', $user)->first();

        foreach ($projects as $project) {
            $project->totalPercentage = $project->tasks->sum('percentage');
            $project->totalTasks = $project->tasks->count();
        }

        $totalProjects = $projects->count();
        $task = TaskList::where('project_id','=', $projectCount->id)->count();
        return view('owner.dashboard', compact('projects', 'totalProjects', 'task'));
    }
}
