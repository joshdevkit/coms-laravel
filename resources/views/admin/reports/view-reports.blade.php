@extends('templates.admin.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Reports</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-4">
        <div class="card card-outline card-success">
            <div class="card-header">
                <b>Project Progress</b>
            </div>
            <div class="card-body">
                <table id="example1" class="table striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project</th>
                            <th>Total Task</th>
                            <th>Completed Task</th>
                            <th>Progress</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            @php
                                $percentage = $project->tasks->first()->percentage ?? 0;
                                $status = '';

                                if ($percentage < 20) {
                                    $status = 'Incomplete';
                                    $statusClass = 'badge-danger'; // Red color for incomplete
                                } elseif ($percentage == 100) {
                                    $status = 'Done';
                                    $statusClass = 'badge-success'; // Green color for done
                                } else {
                                    $remainingPercentage = 100 - $percentage;
                                    $status = "Incomplete ({$remainingPercentage}% More)";
                                    $statusClass = 'badge-primary'; // Blue color for on-going
                                }
                            @endphp
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->project_name }}</td>
                                <td>{{ $project->tasks_count }}</td>
                                <td>{{ $project->tasks->where('status', 'Done')->count() ?? 0 }}</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;"
                                            aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $percentage }}%</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $statusClass }}">{{ $status }}</span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>
@endsection
