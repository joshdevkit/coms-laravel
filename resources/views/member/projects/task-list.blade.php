@extends('templates.member.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Tasks List</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h4>Present and Recent Tasks</h4>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table">
                            <colgroup>
                                <col width="5%">
                                <col width="35%">
                                <col width="35%">
                                <col width="15%">

                            </colgroup>
                            <thead>
                                <th>#</th>
                                <th>Task</th>
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
                                        <td>
                                            <a href="{{ route('member.tasks-mounted', ['taskId' => $task->id]) }}" class="btn btn-info btn-sm">Submit Productivity</a>
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


@endsection
