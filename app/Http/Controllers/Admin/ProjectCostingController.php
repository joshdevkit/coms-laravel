<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectCostingController extends Controller
{
    public function costing()
    {
        return view('admin.project-costing.view');
    }


    public function estimator()
    {
        return view('admin.project-costing.estimator');
    }

}
