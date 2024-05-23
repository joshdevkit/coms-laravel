<?php

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProjectCostingController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UserCrudController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\ManagerProjectController;
use App\Http\Controllers\Manager\TaskListController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\Owner\ProjectController as OwnerProjectController;
use App\Http\Controllers\ProjectManagerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/account-settings',[AccountSettingsController::class,'profile'])->name('admin.account-settings');
    Route::get('/api/project-managers-data', [ProjectManagerController::class, 'manager']);
    Route::get('/api/employee-data', [ProjectManagerController::class, 'tasks']);
    Route::get('/api/hr',[ProjectManagerController::class, 'countHorizontalProjects']);
    Route::get('/api/vt',[ProjectManagerController::class, 'countVerticalProjects']);
    Route::get('/admin/users',[UserCrudController::class, 'index'])->name('admin.users');
    Route::get('/admin/add-user',[UserCrudController::class, 'create'])->name('admin.create');
    Route::post('/admin/store-user',[UserCrudController::class, 'store'])->name('admin.store');
    Route::get('/admin/users/view-data/{id}',[UserCrudController::class, 'info'])->name('admin.view');
    Route::get('/admin/users/edit-data/{id}',[UserCrudController::class, 'edit'])->name('admin.edit');
    Route::get('/admin/reports/view-reports',[ReportsController::class,'reports'])->name('admin.reports');
    Route::delete('/admin/users/delete-user/{removeId}', [UserCrudController::class, 'delete'])->name('admin.delete-user');
    Route::post('/admin/users/disable-user', [UserCrudController::class, 'disabled'])->name('admin.disable-user');
    Route::post('/admin/users/activate-user', [UserCrudController::class, 'activate'])->name('admin.activate-user');
    //project route

    Route::get('/admin/projects/create-project',[ProjectController::class,'create'])->name('admin.create-project');
    Route::post('/admin/projects/store-project',[ProjectController::class,'store'])->name('admin.store-project');
    Route::get('/admin/projects/view-projects',[ProjectController::class,'index'])->name('admin.view-projects');

    Route::post('/admin/projects/update-project',[ProjectController::class,'update'])->name('admin.update-project');
    Route::get('/admin/projects/view-details/{id}',[ProjectController::class,'view']);
    Route::get('/admin/projects/edit-details/{id}',[ProjectController::class,'edit']);

    Route::post('/admin/projects/view-projects', [ProjectController::class, 'delete'])->name('admin.delete-projects');

    Route::controller(ProjectCostingController::class)->group(function(){
        Route::get('/admin/project-costing/costing','costing')->name('admin.costing');
        Route::get('/admin/project-costing/estimator','estimator')->name('admin.estimator');
    });

    Route::post('/admin/project-costing/generate-pdf',[PDFController::class,'generatePDF'])->name('admin.print-pdf');
});

//owner routes
Route::middleware(['auth', 'isOwner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
    Route::get('/owner/account-settings',[AccountSettingsController::class,'profile'])->name('owner.account-settings');
    Route::get('/owner/chage-password',[AccountSettingsController::class, 'change'])->name('owner.change-password');
    Route::post('/owner/chage-password',[AccountSettingsController::class, 'update_change'])->name('owner.change-password');
    Route::post('/owner/chage-password-otp',[AccountSettingsController::class, 'verify_otp'])->name('owner.change-password-otp');
    Route::get('/owner/projects/project-list',[OwnerProjectController::class, 'projects'])->name('owner.project-list');
    Route::get('/owner/projects/view-project-details/{id}',[OwnerProjectController::class,'view'])->name('owner.project-details');
    Route::get('/owner/projects/view-project-files/{id}',[OwnerProjectController::class,'files'])->name('owner.project-files');
    Route::get('/owner/projects/view-project-materials/{id}',[OwnerProjectController::class,'materials'])->name('owner.project-materials');
});

//member routes
Route::middleware(['auth', 'isMember'])->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
    Route::get('/member/account-settings',[AccountSettingsController::class,'profile'])->name('member.account-settings');
    Route::get('/member/chage-password',[AccountSettingsController::class, 'change'])->name('member.change-password');
    Route::post('/member/chage-password',[AccountSettingsController::class, 'update_change'])->name('member.change-password');
    Route::post('/member/chage-password-otp',[AccountSettingsController::class, 'verify_otp'])->name('member.change-password-otp');
    Route::get('/member/projects/project-list',[MemberController::class, 'projects'])->name('member.project-list');
    Route::get('/member/projects/view-project-details/{id}',[MemberController::class,'view'])->name('member.project-details');


    Route::get('/member/projects/task-list',[MemberController::class,'tasks'])->name('member.task-list');
    Route::get('/member/projects/task-mounted/{taskId}',[MemberController::class, 'tasksDetails'])->name('member.tasks-mounted');
    Route::post('/member/projects/task-update',[MemberController::class, 'tasksUpdateWithProductivity'])->name('member.add-productivity');
});

//manager routes
Route::middleware(['auth', 'isManager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/projects/project-list',[ManagerProjectController::class, 'projects'])->name('manager.project-list');
    Route::get('/manager/projects/view-project-details/{id}',[ManagerProjectController::class,'view'])->name('manager.project-details');
    Route::get('/manager/projects/view-project-files/{id}',[ManagerProjectController::class,'files'])->name('manager.project-files');
    Route::post('/manager/projects/upload-files',[ManagerProjectController::class,'upload'])->name('manager.file-upload');
    Route::get('/manager/reports/view-reports',[ManagerProjectController::class,'reports'])->name('manager.reports');
    Route::get('/manager/account-settings',[AccountSettingsController::class,'profile'])->name('manager.account-settings');

    Route::get('/manager/projects/add-estimator/{id}',[ManagerProjectController::class,'estimate'])->name('manager.project-estimator');
    Route::post('/manager/projects/add-estimator',[ManagerProjectController::class,'save'])->name('manager.upload-materials');
    Route::get('/manager/task/task-list',[TaskListController::class, 'tasks'])->name('manager.task-list');
    Route::post('/manager/projects/add-task',[TaskListController::class, 'create'])->name('manager.add-task');
    Route::get('/manager/projects/retrieve-task/{id}', [TaskListController::class, 'retrieve'])->name('manager.retrieve-task');
    Route::delete('/manager/projects/delete-task/{id}', [TaskListController::class, 'delete'])->name('manager.delete-task');

    Route::post('/manager/projects/update-task', [TaskListController::class, 'update'])->name('manager.update-task');
    Route::get('/manager/account/reset',[AccountSettingsController::class, 'reset'])->name('manager.reset-link');
    Route::get('/manager/chage-password',[AccountSettingsController::class, 'change'])->name('manager.change-password');
    Route::post('/manager/chage-password',[AccountSettingsController::class, 'update_change'])->name('manager.change-password');
    Route::post('/manager/chage-password-otp',[AccountSettingsController::class, 'verify_otp'])->name('manager.change-password-otp');
});

//first time update password
//manager
Route::get('/manager/update-password-once', [AccountSettingsController::class, 'update_once'])->name('manager.update-once');
Route::post('/manager/update-password-once', [AccountSettingsController::class, 'update_password'])->name('manager.update-password');

//owner
Route::get('/owner/update-password-once', [AccountSettingsController::class, 'update_once'])->name('owner.update-once');
Route::post('/owner/update-password-once', [AccountSettingsController::class, 'update_password'])->name('owner.update-password');

Route::post('/update-account',[AccountSettingsController::class, 'update'])->name('update-account');
//member
Route::get('/member/update-password-once', [AccountSettingsController::class, 'update_once'])->name('member.update-once');
Route::post('/member/update-password-once', [AccountSettingsController::class, 'update_password'])->name('member.update-password');
