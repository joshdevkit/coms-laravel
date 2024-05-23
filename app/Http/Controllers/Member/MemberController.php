<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Productivity;
use App\Models\ProjectList;
use App\Models\ProjectMembers;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->user()->id;
        $projectIds = ProjectMembers::where('user_id', $userId)->pluck('project_id')->unique();
        $projects = ProjectList::whereIn('id', $projectIds)->with(['members', 'tasks'])->get();
        foreach ($projects as $project) {
            $project->totalPercentage = $project->tasks->sum('percentage');
            $project->totalTasks = $project->tasks->count();
        }
        $totalTasks = TaskList::where('member_id', $userId)->count();
        $totalProjects = $projects->count();
        return view('member.dashboard', compact('projects', 'totalTasks', 'totalProjects'));
    }




    public function projects()
    {
        $userId = auth()->user()->id;
        $projects = ProjectList::whereHas('members', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('members')->get();

        return view('member.projects.project-list', compact('projects'));
    }


    public function view($id)
    {
        $details = ProjectList::findOrfail($id);
        $projectId = $details->id;
        $tasks = TaskList::where('project_id', '=', $projectId)->get()->all();
        $members = ProjectMembers::where('project_id', '=', $projectId)->get()->all();
        return view('member.projects.view-details', compact('details', 'members', 'tasks'));
    }


    public function tasks()
    {
        $userId = auth()->user()->id;
        $tasks = TaskList::where('member_id', '=', $userId)->get()->all();
        return view('member.projects.task-list', compact('tasks'));
    }


    public function tasksDetails($taskId)
    {
        $userId = Auth::user()->id;

        $tasksMounted = TaskList::findOrfail($taskId);
        $projectId = $tasksMounted->project_id;
        $projectDetails = ProjectList::where('id', '=', $projectId)->get()->all();

        return view('member.projects.task-mounted', compact('tasksMounted', 'projectDetails'));
    }


    public function tasksUpdateWithProductivity(Request $request)
    {
        $userId = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'description'  => 'required',
            'added_date'  => 'required',
            'start_time'  => 'required',
            'end_time'  => 'required',
            'time_rendered'  => 'required',
            'status'  => 'required',
        ], [
            'subject.required' => 'Please enter a subject.',
            'description.required' => 'Please enter a description.',
            'added_date.required' => 'Please select a date.',
            'start_time.required' => 'Please enter a start time.',
            'end_time.required' => 'Please enter an end time.',
            'time_rendered.required' => 'Please enter the time rendered.',
            'status.required' => 'Please select a status.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $data = $validator->validated();

        Productivity::create([
            'task_id' => $request->input('task_id'),
            'member_id' => $userId,
            'projectId' => $request->input('projectId'),
            'subject' => $request->input('subject'),
            'description' => $data['description'],
            'added_date' => $data['added_date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'time_rendered' => $data['time_rendered'],
        ]);

        TaskList::where('id', $request->input('task_id'))->update([
            'status' => $data['status'],
        ]);

        return redirect()->route('member.project-list');
    }
}
