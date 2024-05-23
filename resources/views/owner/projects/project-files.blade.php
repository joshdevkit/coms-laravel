@extends('templates.owner.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project Files</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                    <div class="card">
                        <div class="card-header">
                            <span><b>File Table:</b></span>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>File</th>
                                        <th>Uploaded By</th>
                                        <th>Uploaded At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                    <tr>
                                        <td>{{ $file->file_text }}</td>
                                        <td>{{ str_replace('project-files/', '', $file->file_name) }}</td>
                                        <td>{{ $file->uploader->fullname }}</td>
                                        <td>{{ date('M d, Y h:i A',strtotime($file->created_at)) }}</td>
                                        <td>
                                            <a href="{{ asset($file->file_name) }}" class="btn btn-primary btn-sm" download>
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
