@extends('templates.member.header')
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



@endsection
