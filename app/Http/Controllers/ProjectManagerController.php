<?php

namespace App\Http\Controllers;

use App\Models\ProjectList;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectManagerController extends Controller
{
    public function manager()
    {
        $projectManagerWithProjectsDone = User::where('type', '=', '2')->get();
        $data = [];
        $colors = ['#f56954', '#00a65a', '#f39c12', '#FF204E', '#00224D', '#F1EF99', '#EBC49F', '#D37676', '#7469B6'];

        foreach ($projectManagerWithProjectsDone as $key => $projectManager) {
            $doneProjectsCount = ProjectList::where('status', '=', 'Done')
                ->where('manager_id', '=', $projectManager->id)
                ->count();

            if ($doneProjectsCount === 0) {
                continue;
            }

            $data[] = [
                'manager_id' => $projectManager->id,
                'manager_name' => $projectManager->fullname,
                'done_projects_count' => $doneProjectsCount,
                'color' => $colors[$key % count($colors)],
            ];
        }

        return response()->json($data);
    }



    public function tasks()
    {
        $employeesWithTasksDone = User::where('type', '=', '3')->get();
        $data = [];
        $colors = ['#f56954', '#00a65a', '#f39c12', '#FF204E', '#00224D', '#F1EF99', '#EBC49F', '#D37676', '#7469B6'];

        foreach ($employeesWithTasksDone as $key => $employee) {
            $doneTasksCount = TaskList::where('status', '=', 'Done')
                ->where('member_id', '=', $employee->id)
                ->count();

            if ($doneTasksCount === 0) {
                continue;
            }

            $data[] = [
                'employee_id' => $employee->id,
                'employee_name' => $employee->fullname,
                'done_tasks_count' => $doneTasksCount,
                'color' => $colors[$key % count($colors)],
            ];
        }

        return response()->json($data);
    }


    public function countHorizontalProjects()
    {
        $data = [];
        $colors = ['#f56954', '#00a65a', '#f39c12', '#FF204E', '#00224D', '#F1EF99', '#EBC49F', '#D37676', '#7469B6'];

        $managers = User::join('project_lists', 'users.id', '=', 'project_lists.manager_id')
            ->leftJoin('task_lists', 'project_lists.id', '=', 'task_lists.project_id')
            ->where('users.type', '2')
            ->where('project_lists.project_type', 'Vertical Type')
            ->select(
                'users.id as manager_id',
                'users.fullname as manager_name',
                'project_lists.project_name',
                \Illuminate\Support\Facades\DB::raw('SUM(task_lists.percentage) as totalPercentage')
            )
            ->groupBy('project_lists.id', 'users.id', 'users.fullname', 'project_lists.project_name')
            ->get();

        foreach ($managers as $key => $manager) {
            $data[] = [
                'manager_id' => $manager->manager_id,
                'manager_name' => $manager->manager_name,
                'project_name' => $manager->project_name,
                'totalPercentage' => $manager->totalPercentage ?? 0,
                'color' => $colors[$key % count($colors)],
            ];
        }

        return response()->json($data);
    }


    public function countVerticalProjects()
    {
        $data = [];
        $colors = ['#f56954', '#00a65a', '#f39c12', '#FF204E', '#00224D', '#F1EF99', '#EBC49F', '#D37676', '#7469B6'];

        $managers = User::join('project_lists', 'users.id', '=', 'project_lists.manager_id')
            ->leftJoin('task_lists', 'project_lists.id', '=', 'task_lists.project_id')
            ->where('users.type', '2')
            ->where('project_lists.project_type', 'Horizontal Type')
            ->select(
                'users.id as manager_id',
                'users.fullname as manager_name',
                'project_lists.project_name',
                \Illuminate\Support\Facades\DB::raw('SUM(task_lists.percentage) as totalPercentage')
            )
            ->groupBy('project_lists.id', 'users.id', 'users.fullname', 'project_lists.project_name')
            ->get();

        foreach ($managers as $key => $manager) {
            $data[] = [
                'manager_id' => $manager->manager_id,
                'manager_name' => $manager->manager_name,
                'project_name' => $manager->project_name,
                'totalPercentage' => $manager->totalPercentage ?? 0,
                'color' => $colors[$key % count($colors)],
            ];
        }

        return response()->json($data);
    }
}
