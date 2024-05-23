<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectList;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function reports()
    {
        $projects = ProjectList::withCount('tasks')->get();
        return view('admin.reports.view-reports', compact('projects'));
    }
}
