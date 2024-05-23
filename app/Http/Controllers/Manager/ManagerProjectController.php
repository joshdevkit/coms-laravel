<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ProjectFileManager;
use App\Models\ProjectList;
use App\Models\ProjectMaterials;
use App\Models\ProjectMembers;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManagerProjectController extends Controller
{
    public function projects()
    {
        $userId = auth()->user()->id;
        $projects = ProjectList::where('manager_id', '=', $userId)->get()->all();
        return view('manager.projects.project-list', compact('projects'));
    }

    public function view($id)
    {
        $details = ProjectList::findOrfail($id);
        $projectId = $details->id;
        $tasks = TaskList::where('project_id', '=', $projectId)->get()->all();
        $members = ProjectMembers::where('project_id', '=', $projectId)->get()->all();
        return view('manager.projects.view-details', compact('details', 'members', 'tasks'));
    }

    public function estimate($id)
    {
        $details = ProjectList::findOrFail($id);
        $materials = ProjectMaterials::where('project_id', $id)->orderBy('id', 'asc')->get();

        $overallTotal = $materials->sum(function ($material) {
            return $material->total_price * $material->quantity;
        });

        return view('manager.projects.project-estimator', compact('materials', 'details', 'overallTotal'));
    }



    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projectId' => 'required',
            'category_section' => 'required',
            'item_name' => 'required|array',
            'quantity' => 'required|array',
            'price' => 'required|array',
            'unit' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', "All Fields are required");
        }


        // If validation passes, continue with your logic
        $materialsData = $request->only(['category_section', 'item_name', 'quantity', 'price', 'unit']);

        $materialCount = count($materialsData['category_section']);

        for ($i = 0; $i < $materialCount; $i++) {
            ProjectMaterials::create([
                'project_id' => $request->input('projectId'),
                'item_name' => $materialsData['item_name'][$i],
                'quantity' => $materialsData['quantity'][$i],
                'category_section' => $materialsData['category_section'][$i],
                'total_price' => $materialsData['price'][$i],
                'unit' => $materialsData['unit'][$i],
            ]);
        }

        // Return success message with success status
        return response()->json(['message' => 'Materials Uploaded Successfully', 'status' => 200]);
    }


    public function files($id)
    {
        $id = $id;
        $details = ProjectList::findOrFail($id);
        $files = ProjectFileManager::where('project_id', $id)->get();
        return view('manager.projects.file-manager', compact('files', 'id', 'details'));
    }


    public function upload(Request $request)
    {
        $userId = Auth::user()->id;

        $request->validate([
            'file_text' => 'required',
            'file_name' => 'required|mimes:pdf,doc,docx,xls,png,jpg,|max:20480',
            'projectId' => 'required',
        ]);

        $uploadedFile = $request->file('file_name');
        $fileName = $uploadedFile->getClientOriginalName();
        $uploadedFile->move(public_path('project-files'), $fileName);

        ProjectFileManager::create([
            'project_id' => $request['projectId'],
            'user_id' => $userId,
            'file_name' => 'project-files/' . $fileName,
            'file_text' => $request['file_text'],
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully');
    }

    // public function download($fileId)
    // {
    //     $file = ProjectFileManager::find($fileId);

    //     if ($file) {
    //         $filePath = public_path('project-files/'.$file->file_name);

    //         return response()->download($filePath, $file->file_text);
    //     }

    //     return abort(404);
    // }


    public function reports()
    {
        $managerId = Auth::id();
        $projects = ProjectList::withCount('tasks')->where('manager_id',$managerId)->get();
        return view('manager.reports.view-reports', compact('projects'));
    }
}
