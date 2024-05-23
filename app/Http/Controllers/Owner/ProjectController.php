<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\ProjectFileManager;
use App\Models\ProjectList;
use App\Models\ProjectMaterials;
use App\Models\ProjectMembers;
use App\Models\TaskList;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function projects()
    {
        $userId = auth()->user()->id;
        $projects = ProjectList::where('project_owner', '=', $userId)->get()->all();
        return view('owner.projects.project-list', compact('projects'));
    }


    public function view($id)
    {
        $details = ProjectList::findOrfail($id);
        $projectId = $details->id;

        $tasks = TaskList::where('project_id', '=', $projectId)->get()->all();
        $members = ProjectMembers::where('project_id', '=', $projectId)->get()->all();
        return view('owner.projects.view-details', compact('details', 'members', 'tasks'));
    }


    public function files($projectId)
    {
        $files = ProjectFileManager::where('project_id',$projectId)->get();
        return view('owner.projects.project-files', compact('files'));
    }


    public function materials($projectId)
    {
        $details = ProjectList::findOrFail($projectId);
        $materials = ProjectMaterials::where('project_id', $projectId)->orderBy('id', 'asc')->get();

        $overallTotal = $materials->sum(function ($material) {
            return $material->total_price * $material->quantity;
        });

        return view('owner.projects.project-materials', compact('materials', 'details', 'overallTotal'));
    }
}
