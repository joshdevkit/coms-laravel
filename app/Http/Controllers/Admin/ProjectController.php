<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Productivity;
use App\Models\ProjectFileManager;
use App\Models\ProjectList;
use App\Models\ProjectMaterials;
use App\Models\ProjectMembers;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create()
    {
        $users = User::where('type', '=', 2)->get();
        $members = User::whereNotIn('type', [0, 1])->get();
        $owners = User::where('type', '=', 0)->get();
        return view('admin.projects.create-project', compact('users', 'members', 'owners'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'project_type' => 'required',
            'selected_category_val' => 'required',
            'budget' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'manager_id' => 'required',
            'description' => 'required',
            'owner_id' => 'required',
            'region' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = "";

        if (!empty($request->input('storey'))) {
            $data = $request->input('storey');
        }

        if (!empty($request->input('length'))) {
            $data = $request->input('length');
        }

        $project_location_codes = array(
            'region' => $request->input('region_code'),
            'province' => $request->input('province_code'),
            'city' => $request->input('city_code'),
            'barangay' => $request->input('barangay_code'),
        );

        $project_location_text = array(
            'region' => $request->input('region_text'),
            'province' => $request->input('province_text'),
            'city' => $request->input('city_text'),
            'barangay' => $request->input('barangay_text'),
        );

        $code = serialize($project_location_codes);
        $text = serialize($project_location_text);

        $project = ProjectList::create([
            'manager_id' => $request->input('manager_id'),
            'project_name' => $request->input('name'),
            'project_type' => $request->input('project_type'),
            'category' => $request->input('selected_category_val'),
            'category_type' => $data,
            'total_budget' => $request->input('budget'),
            'project_owner' => $request->input('owner_id'),
            'description' => $request->input('description'),
            'project_location_text' => $text,
            'project_location_codes' => $code,
            'status' => $request->input('status'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        $projectId = $project->id;
        $selectedUserIds = $request->input('user_ids', []);

        foreach ($selectedUserIds as $index => $memberId) {
            ProjectMembers::create([
                'user_id' => $memberId,
                'project_id' => $projectId,
            ]);
        }



        return redirect()->back()->with('success', 'New Project has been Created!');
    }

    public function index()
    {
        $projects = ProjectList::get();
        return view('admin.projects.view-projects', compact('projects'));
    }

    public function view($id)
    {
        $details = ProjectList::findOrfail($id);
        $projectId = $details->id;
        $tasks = TaskList::where('project_id', '=', $projectId)->get()->all();
        $members = ProjectMembers::where('project_id', '=', $projectId)->get()->all();

        $productivity = Productivity::where('projectId', '=', $projectId)->with('members')->get()->all();

        return view('admin.projects.view-details', compact('details', 'members', 'tasks', 'productivity'));
    }

    public function edit($id)
    {
        $details = ProjectList::findOrfail($id);
        $projectId = $details->id;
        $owners = User::where('type', '=', '0')->get();
        $tasks = TaskList::where('project_id', '=', $projectId)->get()->all();
        $projectMembers = ProjectMembers::where('project_id', '=', $projectId, 'AND', 'type', '=', 3)->pluck('user_id')->toArray();
        $members = User::all();
        $manager = User::where('type', '=', 2)->get();
        return view('admin.projects.edit-details', compact('details', 'members', 'tasks', 'owners', 'projectMembers', 'manager'));
    }

    public function update(Request $request)
    {
        $projectId = $request->input('projectId');

        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'status' => 'required',
            'project_type' => 'required',
            'selected_category_val' => 'required',
            'budget' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'manager_id' => 'required',
            'description' => 'required',
            'owner_id' => 'required',
            'region' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'user_ids' => 'required|array'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $existingProjectMembers = ProjectMembers::where('project_id', $projectId)->pluck('user_id')->toArray();

        $updatedProjectMembers = $request->input('user_ids');

        $addedMembers = array_diff($updatedProjectMembers, $existingProjectMembers);
        $removedMembers = array_diff($existingProjectMembers, $updatedProjectMembers);
        $unchangedMembers = array_intersect($existingProjectMembers, $updatedProjectMembers);

        // Process added members
        foreach ($addedMembers as $userId) {
            ProjectMembers::create([
                'project_id' => $projectId,
                'user_id' => $userId,
                // Additional fields if any
            ]);
        }
        $data = "";

        if (!empty($request->input('storey'))) {
            $data = $request->input('storey');
        }

        if (!empty($request->input('length'))) {
            $data = $request->input('length');
        }

        $project_location_codes = array(
            'region' => $request->input('region_code'),
            'province' => $request->input('province_code'),
            'city' => $request->input('city_code'),
            'barangay' => $request->input('barangay_code'),
        );

        $project_location_text = array(
            'region' => $request->input('region_text'),
            'province' => $request->input('province_text'),
            'city' => $request->input('city_text'),
            'barangay' => $request->input('barangay_text'),
        );

        $code = serialize($project_location_codes);
        $text = serialize($project_location_text);

        $budget = $request->input('budget');
        $replacedBudget = (int) str_replace(',', '', $budget);

        ProjectMembers::where('project_id', $projectId)
            ->whereIn('user_id', $removedMembers)
            ->delete();


        $project = ProjectList::findOrFail($projectId);
        $project->project_name = $request->input('project_name');
        $project->status = $request->input('status');
        $project->project_type = $request->input('project_type');
        $project->category = $request->input('selected_category_val');
        $project->total_budget = $replacedBudget;
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->manager_id = $request->input('manager_id');
        $project->description = $request->input('description');
        $project->project_owner  = $request->input('owner_id');

        $project->project_location_codes = $code;

        $project->project_location_text = $text;
        $project->save();

        return redirect()->back()->with('success','Project Details has been updated');
    }

    public function delete(Request $request)
    {
        $removeId = $request->input('projectId');
        ProjectFileManager::where('project_id', $removeId)->delete();
        ProjectMaterials::where('project_id', $removeId)->delete();
        TaskList::where('project_id', $removeId)->delete();
        ProjectMembers::where('project_id', $removeId)->delete();
        ProjectList::where('id', $removeId)->delete();

        return redirect()->back()->with('success', 'Project and related tasks/members removed successfully.');
    }

}
