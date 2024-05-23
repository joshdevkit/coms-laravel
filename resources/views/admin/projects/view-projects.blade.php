@extends('templates.admin.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project Management</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-header">
                <h4>
                    All Projects
                    <a href="{{ route('admin.create-project') }}" class="btn btn-primary float-right"><i
                            class="fas fa-user-plus"></i> Create New
                        Projects</a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-text="true">&times;</span>
                        </button>
                    </div>
                @endif
                <table id="example1" class="table striped table-hover">
                    <thead>
                        <tr>
                            <th>PROJECT</th>
                            <th>MANAGE BY</th>
                            <th>PROJECT TYPE</th>
                            <th>PROJECT CLASIFICATION</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $row)
                            <tr>
                                <td>{{ $row->project_name }}</td>
                                <td>{{ $row->manager->fullname }}</td>
                                <td>{{ $row->project_type }}</td>
                                <td>{{ $row->category }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="/admin/projects/view-details/{{ $row->id }}">View</a>
                                            <a class="dropdown-item"
                                                href="/admin/projects/edit-details/{{ $row->id }}">Edit</a>
                                            <button type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#confirmDeleteModal_{{ $row->id }}">Delete</button>
                                        </div>
                                        <div class="modal fade" id="confirmDeleteModal_{{ $row->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this project?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <form method="POST"
                                                            action="{{ route('admin.delete-projects') }}"
                                                            id="deleteForm">
                                                            @csrf
                                                            <input type="hidden" name="projectId" value="{{ $row->id }}">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
