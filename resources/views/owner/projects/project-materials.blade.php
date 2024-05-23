@extends('templates.owner.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project Material Used</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h5>Project Materials
                            {{-- <button type="button" id="add_btn_i" class="btn btn-primary add_btn float-right">Add Now</button> --}}
                        </h5>
                    </div>
                    <div class="card-body" id="data_table">
                        @if ($materials->isEmpty())
                            <p>No Materials have been added yet.</p>
                            {{-- <button type="button" id="add_btn_i" class="btn btn-primary add_btn">Add Now</button> --}}
                        @else
                        <div class="card">
                            <div class="card-body">
                                <div class="card-text">
                                    <h5>Project Name: {{ $details->project_name }}</h5>
                                    <h5>Project Manager: {{ $details->manager->fullname }}</h5>
                                    <h5>Project Owner: You own this Project</h5>
                                    <h5>Project Cost: {{ number_format($details->total_budget,2) }}</h5>

                                    <h5>Project Remaining Balance: {{ number_format(($details->total_budget - $overallTotal), 2) }}</h5>

                                </div>
                            </div>
                        </div>
                        <table id="example1" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Category/Section</th>
                                    <th>Materials</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Unit Price</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materials as $material)
                                <tr>
                                    <td>{{ $material->category_section }}</td>
                                    <td>{{ $material->item_name }}</td>
                                    <td>{{ $material->quantity }}</td>

                                    <td>{{ $material->unit }}</td>
                                    <td>{{ number_format($material->total_price),2 }}</td>
                                    <td>{{ number_format($material->total_price * $material->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-secondary">
                                    <th colspan="5">Overall Total:</th>
                                    <th colspan="1">
                                        @php
                                            $overallTotal = 0;
                                            foreach ($materials as $material) {
                                                $overallTotal += $material->total_price * $material->quantity;
                                            }
                                            echo number_format($overallTotal, 2);
                                        @endphp
                                    </th>
                                </tr>
                            </tfoot>
                        </table>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
@endsection
