@extends('templates.admin.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Project Costing</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">ESTIMATED PROJECT COSTING</h4>
                </div>
                <div class="card-body">
                    <form id="projectForm">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="projectName">Project Name:</label>
                                <input type="text" class="form-control" id="projectName" required>
                            </div>
                            <div class="col-md-5">
                                <label for="totalArea">Total Area (m<sup>2</sup>):</label>
                                <input type="number" class="form-control" id="totalArea" step="0.01" required>
                            </div>
                            <div class="col-md-0">
                                <label for="">&nbsp;</label>
                                <button type="submit" class="btn btn-primary" style="margin-top: 2em;">Calculate</button>
                            </div>
                        </div>
                    </form>
                    <div id="result" class="mt-3"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid d-none" id="details_statis">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-6">
                            <h1 class="text-center text-primary mb-5" id="project_name"></h1>
                            <div class="row">
                                <div style="margin-top: 185px;" class="col-md-3">
                                    <label class="text-primary" for=""><h4>Floor</h4></label><br>
                                    <label class="text-primary" for=""><h4>Wall</h4></label><br>
                                    <label class="text-primary" for=""><h4>Window</h4></label><br>
                                    <label class="text-primary" for=""><h4>Ceiling</h4></label><br>
                                    <label class="text-primary" for=""><h4>Amount</h4></label><br>
                                </div>
                                <div class="col-md-3">
                                    <img class="w-75" src="{{ asset('static/Capture1.JPG') }}" alt="{{ asset('static/Capture1.JPG') }}">
                                    <label class="text-primary" for=""><h4>Bare</h4></label><br>
                                    <label class="text-primary" for=""><h4>Concrete</h4></label><br>
                                    <label class="text-primary" for=""><h4>Concrete</h4></label><br>
                                    <label class="text-primary" for=""><h4>Minimal</h4></label><br>
                                    <label class="text-primary" for=""><h4>None</h4></label><br>
                                    <label class="text-primary" for=""><h4 id="first_amount"></h4></label><br>
                                </div>
                                <div class="col-md-3">
                                    <img class="w-75" src="{{ asset('static/Capture2.JPG') }}" alt="{{ asset('static/Capture1.JPG') }}">
                                    <label class="text-primary" for=""><h4>Standard</h4></label><br>
                                    <label class="text-primary" for=""><h4>Tiles</h4></label><br>
                                    <label class="text-primary" for=""><h4>Paint</h4></label><br>
                                    <label class="text-primary" for=""><h4>Standard</h4></label><br>
                                    <label class="text-primary" for=""><h4>Gypsum</h4></label><br>
                                    <label class="text-primary" for=""><h4 id="second_amount"></h4></label><br>

                                </div>
                                <div class="col-md-3">
                                    <img class="w-75" src="{{ asset('static/Capture3.JPG') }}" alt="{{ asset('static/Capture1.JPG') }}">
                                    <label class="text-primary" for=""><h4>Luxury</h4></label><br>
                                    <label class="text-primary" for=""><h4>Tiles</h4></label><br>
                                    <label class="text-primary" for=""><h4>Cladding</h4></label><br>
                                    <label class="text-primary" for=""><h4>Full Window</h4></label><br>
                                    <label class="text-primary" for=""><h4>PVC</h4></label><br>
                                    <label class="text-primary" for=""><h4 id="third_amount"></h4></label><br>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
