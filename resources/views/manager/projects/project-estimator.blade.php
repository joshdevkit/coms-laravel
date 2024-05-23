@extends('templates.manager.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project Material Used</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
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
                            <button type="button" id="add_btn_i" class="btn btn-primary add_btn float-right">Add
                                Now</button>
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
                                        <h5>Project Owner: {{ $details->owner->fullname }}</h5>
                                        <h5>Project Cost: {{ number_format($details->total_budget, 2) }}</h5>

                                        <h5>Project Remaining Balance:
                                            {{ number_format($details->total_budget - $overallTotal, 2) }}</h5>

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

                                            <td>{{ number_format($material->total_price, 2) }}</td>
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

                        <form id="submitForm">
                            @csrf
                            <div id="total" class="col-sm-6 mt-3 mb-4 d-none">
                                <strong> Project Budget : {{ number_format($details->total_budget, 2) }}</strong>
                                <input type="hidden" name="projectId" value="{{ $details->id }}">
                            </div>
                            <table class="table table-bordered d-none" id="add_table">
                                <thead>
                                    <tr>
                                        <th>Category/Section</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Unit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="material_table"></tbody>
                            </table>
                            <button type="submit" id="saveBtn" class="btn btn-primary d-none">Upload Materials</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#add_btn_i').on('click', function() {
                $('.add_btn').addClass('d-none');
                $('#add_table').removeClass('d-none');
                $('#total').removeClass('d-none');
                $('#saveBtn').removeClass('d-none');
                addMaterialRow();
            });

            $('#material_table').on('click', '.add-material', function() {
                addMaterialRow();
            });

            $('#submitForm').on('submit', function(e) {
                e.preventDefault();
                var isValid = true;

                $('.required').each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (isValid) {
                    var formData = $(this).serialize();
                    $.ajax({
                        url: '{{ route('manager.upload-materials') }}',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                location.reload()

                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                        }
                    });
                }
            });

            // Add material row function
            function addMaterialRow() {
                var categories = ["SITE CONSTRUCTION", "CONCRETE WORKS", "MASONRY", "METAL WORKS",
                    "THERMAL AND MOISTURE PROTECTION", "DOORS AND WINDOWS", "FINISHES", "SPECIALTIES",
                    "SPECIAL CONSTRUCTION", "CONVEYING SYSTEMS", "MECHANICAL", "ELECTRICAL"
                ];

                var dropdownOptions = '';

                for (var i = 0; i < categories.length; i++) {
                    dropdownOptions += '<option value="' + categories[i] + '">' + categories[i] + '</option>';
                }

                var newRow = '<tr>' +
                    '<td><select class="form-control form-select required" name="category_section[]"><option value="">Select</option>' +
                    dropdownOptions + '</select></td>' +
                    '<td><input type="text" name="item_name[]" class="form-control required" placeholder="Item Name"></td>' +
                    '<td><input type="number" name="quantity[]" class="form-control required" placeholder="Quantity"></td>' +
                    '<td><input type="number" name="price[]" class="form-control required" placeholder="Price"></td>' +
                    '<td><input type="text" name="unit[]" class="form-control required" placeholder="Unit"></td>' +
                    '<td><button type="button" class="btn btn-danger btn-sm remove-material">Remove</button></td>' +
                    '</tr>';

                $('#material_table .add-material-row').remove();
                $('#material_table').append(newRow);

                $('#material_table tr:last').after(
                    '<tr class="add-material-row"><td colspan="6"><button type="button" class="btn btn-sm btn-primary add-material">Add More</button></td></tr>'
                );
            }

            $('#material_table').on('click', '.remove-material', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>


@endsection
