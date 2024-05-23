@extends('templates.manager.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project Details</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-text="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-info">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <dl>
                                    <dt><b class="border-bottom border-primary">Project Name</b></dt>
                                    <dd>{{ $details->project_name }}</dd>
                                    <dt><b class="border-bottom border-primary">Description</b></dt>
                                    <dd>{{ $details->description }}</dd>
                                    <dt><b class="border-bottom border-primary">Project Location</b></dt>
                                    @php
                                        $location = unserialize($details->project_location_text);
                                    @endphp
                                    <dd>
                                        @if (is_array($location))
                                            <strong>Region:</strong> {{ $location['region'] }}<br>
                                            <strong>Province:</strong> {{ $location['province'] }}<br>
                                            <strong>City:</strong> {{ $location['city'] }}<br>
                                            <strong>Barangay:</strong> {{ $location['barangay'] }}
                                        @else
                                            Not Available
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl>
                                    <dt><b class="border-bottom border-primary">Start Date</b></dt>
                                    <dd>{{ date('F m, Y', strtotime($details->start_date)) }}</dd>
                                </dl>
                                <dl>
                                    <dt><b class="border-bottom border-primary">End Date</b></dt>
                                    <dd>{{ date('F m, Y', strtotime($details->end_date)) }}</dd>
                                </dl>
                                <dl>
                                    <dt><b class="border-bottom border-primary">Status</b></dt>
                                    <dd>
                                        @if ($details->status == 'Pending')
                                            <span class='badge badge-secondary'>{{ $details->status }}</span>
                                        @elseif($details->status == 'Started')
                                            <span class='badge badge-primary'>{{ $details->status }}</span>
                                        @elseif($details->status == 'On-Progress')
                                            <span class='badge badge-info'>{{ $details->status }}</span>
                                        @elseif($details->status == 'On-Hold')
                                            <span class='badge badge-warning'>{{ $details->status }}</span>
                                        @elseif($details->status == 'Over Due')
                                            <span class='badge badge-danger'>{{ $details->status }}</span>
                                        @elseif($details->status == 'Done')
                                            <span class='badge badge-success'>{{ $details->status }}</span>
                                        @endif
                                    </dd>

                                </dl>
                                <dl>
                                    <dt><b class="border-bottom border-primary">Project Manager</b></dt>
                                    <dd>

                                        <div class="d-flex align-items-center mt-1">
                                            <img class="img-circle img-thumbnail p-0 shadow-sm border-info img-sm mr-3"
                                                src="{{ asset($details->manager->avatar) }}" alt="Avatar">
                                            @if (auth()->check() && $details->manager->fullname == auth()->user()->fullname)
                                                <b>You</b>
                                            @else
                                                <b>Mr./Mrs. {{ $details->manager->fullname }}</b>
                                            @endif
                                        </div>
                                    </dd>
                                    <dt><b class="border-bottom border-primary">Project Owner</b></dt>
                                    <dd>

                                        <div class="d-flex align-items-center mt-1">
                                            <img class="img-circle img-thumbnail p-0 shadow-sm border-info img-sm mr-3"
                                                src="{{ asset($details->owner->avatar) }}" alt="Avatar">
                                            <b>Mr./Mrs. {{ $details->owner->fullname }}</b>
                                        </div>

                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <span><b>Team Member/s:</b></span>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="users-list clearfix">
                            @foreach ($members as $member)
                                <li>
                                    <img class="w-50" style="height: 50px;" src="{{ asset($member->members->avatar) }}"
                                        alt="User Image">
                                    <p class="d-flex inline-block">{{ $member->members->fullname }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <span><b>Task List:</b></span>
                        <button type="button" data-toggle="modal" data-target="#addNewTask"
                            class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> New
                            Task
                        </button>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table id="example1" class="table table-condensed m-0 table-hover">
                                <colgroup>
                                    <col width="5%">
                                    <col width="25%">
                                    <col width="30%">
                                    <col width="15%">
                                    <col width="15%">
                                </colgroup>
                                <thead>
                                    <th>#</th>
                                    <th>Task</th>
                                    <th>Member Associated</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @forelse ($tasks as $task)
                                        @php
                                            $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                                            unset($trans["\""], $trans['<'], $trans['>'], $trans['<h2']);
                                            $desc = strtr(html_entity_decode($task->description), $trans);
                                            $desc = str_replace(['<li>', '</li>', '&nbsp;'], ['', ', ', ' '], $desc);
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $task->id }}</td>
                                            <td class=""><b>{{ $task->task_name }}</b></td>
                                            <td>{{ $task->taskfor->fullname }}</td>
                                            <td class="">
                                                <p class="truncate">{{ strip_tags($desc) }}</p>
                                            </td>
                                            <td>
                                                @if ($task->status == 'Pending')
                                                    <span class='badge badge-secondary'>{{ $task->status }}</span>
                                                @elseif($task->status == 'Started')
                                                    <span class='badge badge-primary'>{{ $task->status }}</span>
                                                @elseif($task->status == 'On-Progress')
                                                    <span class='badge badge-info'>{{ $task->status }}</span>
                                                @elseif($task->status == 'On-Hold')
                                                    <span class='badge badge-warning'>{{ $task->status }}</span>
                                                @elseif($task->status == 'Over Due')
                                                    <span class='badge badge-danger'>{{ $task->status }}</span>
                                                @elseif($task->status == 'Done')
                                                    <span class='badge badge-success'>{{ $task->status }}</span>
                                                @endif
                                                </dd>
                                            </td>
                                            <td class="text-center">
                                                <button type="button"
                                                    class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="true">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" style="">
                                                    <div class="dropdown-divider"></div>
                                                    <button type="button" class="dropdown-item" data-toggle="modal"
                                                        data-target="#editUserTask_{{ $task->id }}">Edit</button>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_task" href="javascript:void(0)"
                                                        data-id="{{ $task->id }}">Delete</a>
                                                </div>

                                            </td>
                                            <div class="modal fade" id="editUserTask_{{ $task->id }}" tabindex="-1"
                                                aria-labelledby="editTaskLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editTaskLabel">Edit Task</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('manager.update-task') }}">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="task_name">Task</label>
                                                                    <input type="text" name="task_name"
                                                                        value="{{ $task->task_name }}"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="member_id">Assign To</label>
                                                                    <select name="member_id" id="member_id" class="form-control">
                                                                        <option value="">Select Member</option>
                                                                        @foreach ($members as $member)
                                                                            <option value="{{ $member->members->id }}" {{ $member->members->id == $task->member_id ? 'selected' : '' }}>
                                                                                {{ $member->members->fullname }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="description">Description</label>
                                                                    <textarea disabled class=" form-control summernote" name="description_selected" id="description_selected"
                                                                        cols="30" rows="5">{{ $task->description }}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="Status">Status</label>
                                                                    <select name="status" id="selected_status" class="form-control form-select">
                                                                        <option value="">Select Status</option>
                                                                        <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                        <option value="On-going" {{ $task->status === 'On-going' ? 'selected' : '' }}>On-going</option>
                                                                        <option value="On-Progress" {{ $task->status === 'On-Progress' ? 'selected' : '' }}>On-Progress</option>
                                                                        <option value="Started" {{ $task->status === 'Started' ? 'selected' : '' }}>Started</option>
                                                                        <option value="Done" {{ $task->status === 'Done' ? 'selected' : '' }}>Done</option>
                                                                    </select>
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="taskId" value="{{ $task->id }}">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Task</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Task Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewTask" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="addNewTaskLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewTaskLabel">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-text="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('manager.add-task') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="task_name">Task</label>
                            <input type="text" name="task_name" id="task_name"
                                class="@error('task_name') is-invalid @enderror form-control">
                            @error('task_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="member_id">Assign To</label>
                            <select name="member_id" id="member_id"
                                class="@error('member_id') is-invalid @enderror form-control form-select">
                                <option value="">Select Member</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->members->id }}">{{ $member->members->fullname }}</option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="@error('description') is-invalid @enderror form-control summernote" name="description"
                                id="description" cols="30" rows="5"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Percentage</label>
                            <input type="range" class="@error('percentage') is-invalid @enderror form-control-range"
                                name="percentage" id="formControlRange" min="1" max="100" value="1">
                            <output id="rangeValue">1%</output>
                            @error('percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="projectId" value="{{ $details->id }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('formControlRange').addEventListener('input', function() {
            document.getElementById('rangeValue').textContent = this.value + '%';
        });
        // $(document).ready(function() {
        //     $('.edit_task').on('click', function() {
        //         var id = $(this).data('id');
        //         console.log(id);
        //         $('#editTask').modal('show');

        //         $.ajax({
        //             url: `/manager/projects/retrieve-task/${id}`,
        //             type: 'GET',
        //             success: function(response) {
        //                 console.log(response)
        //                 $('#task_name_selected').val(response.task_name)
        //                 $('#description_selected').summernote('code', response.description);
        //                 $('#member_name').val(response.taskfor.fullname)
        //                 $('#selected_status').empty().append(`
    //                     <option value="Pending" ${response.status === 'Pending' ? 'selected' : ''}>Pending</option>
    //                     <option value="On-going" ${response.status === 'On-going' ? 'selected' : ''}>On-going</option>
    //                     <option value="On-Progress" ${response.status === 'On-Progress' ? 'selected' : ''}>On-Progress</option>
    //                     <option value="Started" ${response.status === 'Started' ? 'selected' : ''}>Started</option>
    //                     <option value="Done" ${response.status === 'Done' ? 'selected' : ''}>Done</option>
    //                 `);
        //                 $('#taskIdSelected').val(response.id)
        //             },
        //         });
        //     });
        // })
        $('.delete_task').on('click', function() {
            var DataId = $(this).data('id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/manager/projects/delete-task/${DataId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            if (response.status == 200) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Task has been Removed.",
                                    icon: "success"
                                });
                                setTimeout(() => {
                                    location.reload()
                                }, 1500);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            Swal.fire({
                                title: "Error!",
                                text: "An error occurred while deleting the task.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
