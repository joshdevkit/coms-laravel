@extends('templates.admin.header')
@section('content')
    <style>
        .input-field {
            position: relative;
        }

        .input-field::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: black;
            bottom: 2px;
            left: 0;
            margin: auto;
        }

        .text-only {
            border: none;
        }

        input {
            border: none;
            outline: none;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project Estimator</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">ESTIMATED BILL OF QUANTITIES</h4>
                    <label>Project Name:</label>
                    <div class="col-md-6 input-field">
                        <input type="text" class="form-control text-only">
                    </div>
                </div>
                <div class="card-body" id="multiple_table">
                    <div class='row'>
                        <div class='col-md-12'>
                            <h5 class="text-primary">Site Construction</h5>
                            <table class='table table-bordered table-sm' id="first_table">
                                <colgroup>
                                    <col width="5%">
                                    <col width="30%">
                                    <col width="15%">
                                    <col width="15%">
                                    <col width="15%">
                                    <col width="15%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody id='product_tbody'>
                                    <tr>
                                        <td><input type='text' readonly name='number[]' class='form-control number'></td>
                                        <td><input type='text' required name='description[]' class='form-control description'></td>
                                        <td><input type='text' required name='qty[]' class='form-control qty'></td>
                                        <td><input type='text' required name='unit[]' class='form-control unit'></td>
                                        <td><input type='text' required name='rate[]' class='form-control rate'></td>
                                        <td><input type='text' required name='amount[]' class='form-control amount'></td>
                                        <td><input type='button' value='x' class='btn btn-danger btn-sm btn-row-remove'></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type='button' value='+ Add Row' class='btn btn-primary btn-sm' id='btn-add-row'></td>
                                        <td colspan='4' class='text-right'>TOTAL AMOUNT</td>
                                        <td><input type='text' name='grand_total' id='grand_total' class='form-control' required></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
