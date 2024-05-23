@extends('templates.manager.header')
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
                        @foreach($projects as $index => $project)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $project->project_name }}</td>
                                <td>{{ $project->tasks_count }}</td>
                                <td>{{ $project->tasks->where('status', 'Done')->count() }}</td>
                                <td>
                                    <div class="progress">
                                        @if ($project->totalPercentage == 100)
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: 100%;" aria-valuenow="100" aria-valuemin="0"
                                                aria-valuemax="100">100%</div>
                                        @else
                                            <div class="progress-bar {{ $project->totalPercentage >= 1 && $project->totalPercentage <= 10 ? 'bg-danger' : ($project->totalPercentage >= 11 && $project->totalPercentage <= 20 ? 'bg-warning' : ($project->totalPercentage >= 21 && $project->totalPercentage <= 40 ? 'bg-info' : 'bg-success')) }}"
                                                role="progressbar" style="width: {{ $project->totalPercentage }}%;"
                                                aria-valuenow="{{ $project->totalPercentage }}" aria-valuemin="0"
                                                aria-valuemax="100">{{ $project->totalPercentage }}%</div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $totalPercentage = $project->tasks->sum('percentage');
                                        $completedTasks = $project->tasks->where('status', 'Done')->count();
                                        $totalTasks = $project->tasks->count();
                                    @endphp

                                    @if ($completedTasks > 0 && $totalPercentage == 100)
                                        <span class="badge badge-sm bg-success">Finished</span>
                                    @else
                                        <span class="badge badge-sm bg-danger">Incomplete</span>
                                    @endif
                                </td>



                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
