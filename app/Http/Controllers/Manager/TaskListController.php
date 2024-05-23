<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\TaskList;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskListController extends Controller
{
    public function tasks()
    {
        return view('manager.tasks.task-list');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_name' => 'required',
            'member_id' => 'required',
            'description' => 'required',
            'percentage' => ['required', 'integer', 'min:1', 'max:100'],
            'projectId' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('showModal', true);
        }

        TaskList::create([
            'project_id' => $request->input('projectId'),
            'member_id' => $request->input('member_id'),
            'task_name' => $request->input('task_name'),
            'description' => $request->input('description'),
            'percentage' => $request->input('percentage'),
        ]);

        return redirect()->back()->with(['success' => 'Record created successfully!', 'showModaladd' => true]);
    }

    public function retrieve($id)
    {
        $details = TaskList::with('taskfor')->findOrfail($id);

        return $details;
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'taskId' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $task = TaskList::find($request->input('taskId'));

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->status = $request->input('status');
        $task->save();

        return redirect()->back()->with(['message' => 'Task updated successfully', 'showModal' => true]);
    }


    public function delete($taskId)
    {
        $task = TaskList::findOrFail($taskId);

        $task->delete();

        return response()->json(['status'=> 200]);
    }
}
