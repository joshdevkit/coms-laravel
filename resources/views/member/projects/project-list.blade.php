@extends('templates.member.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project List</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid ">
        <div class="row">
            <div class="col-m-d-12 col-lg-12 col-sm-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h5>Project Progress</h5>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>Progress</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->project_name }}</td>
                                    <td>
                                        <div class="progress">
                                            @if ($row->totalPercentage == 100)
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 100%;" aria-valuenow="100" aria-valuemin="0"
                                                    aria-valuemax="100">100%</div>
                                            @else
                                                <div class="progress-bar {{ $row->totalPercentage >= 1 && $row->totalPercentage <= 10 ? 'bg-danger' : ($row->totalPercentage >= 11 && $row->totalPercentage <= 20 ? 'bg-warning' : ($row->totalPercentage >= 21 && $row->totalPercentage <= 40 ? 'bg-info' : 'bg-success')) }}"
                                                    role="progressbar" style="width: {{ $row->totalPercentage }}%;"
                                                    aria-valuenow="{{ $row->totalPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">{{ $row->totalPercentage }}%</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $totalPercentage = $row->tasks->sum('percentage');
                                            $completedTasks = $row->tasks->where('status', 'Done')->count();
                                            $totalTasks = $row->tasks->count();
                                        @endphp

                                        @if ($completedTasks > 0 && $totalPercentage == 100)
                                            <span class="badge badge-sm bg-success">Finished</span>
                                        @else
                                            <span class="badge badge-sm bg-danger">Incomplete</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('member.project-details', ['id' => $row->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-folder"></i> View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="5">No Project Available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
