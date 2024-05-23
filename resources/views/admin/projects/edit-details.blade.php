@extends('templates.admin.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-text="true">&times;</span>
                </button>
            </div>
        @endif
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Project Details / {{ $details->project_name }}</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.update-project') }}" method="POST">
                    @csrf
                    <input type="hidden" name="projectId" value="{{ $details->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Name</label>
                                <input type="text" value="{{ $details->project_name }}"
                                    class="form-control @error('project_name') is-invalid @enderror" name="project_name">
                                @error('project_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" id="status"
                                    class="form-select form-control @error('status') is-invalid @enderror"
                                    value="{{ old('status') }}">
                                    <option value="">Select Status</option>
                                    <option value="Pending" {{ $details->status === 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="On-hold" {{ $details->status === 'On-Hold' ? 'selected' : '' }}>On-Hold
                                    </option>
                                    <option value="On-going" {{ $details->status === 'On-going' ? 'selected' : '' }}>
                                        On-going
                                    </option>
                                    <option value="Done" {{ $details->status === 'Done' ? 'selected' : '' }}>Done
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Project Type</label>
                                <select name="project_type" id="project_type"
                                    class="form-select form-control @error('project_type') is-invalid @enderror">
                                    <option value="">Visualization of Type of Projects</option>
                                    <option value="Vertical Type"
                                        {{ $details->project_type == 'Vertical Type' ? 'selected' : '' }}>Vertical Type
                                    </option>
                                    <option value="Horizontal Type"
                                        {{ $details->project_type == 'Horizontal Type' ? 'selected' : '' }}>Horizontal Type
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="selected_category_val" id="selected_category_val"
                                    class="form-select form-control @error('selected_category_val') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    <option value="Kalsada" {{ $details->category == 'Kalsada' ? 'selected' : '' }}>Kalsada
                                    </option>
                                    <option value="Highway" {{ $details->category == 'Highway' ? 'selected' : '' }}>Highway
                                    </option>
                                    <option value="Bridge" {{ $details->category == 'Bridge' ? 'selected' : '' }}>
                                        Bridge</option>
                                    <option value="Government Facilities"
                                        {{ $details->category == 'Government Facilities' ? 'selected' : '' }}>Government
                                        Facilities</option>
                                </select>
                                @error('selected_category_val')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 <?= $details->project_type == 'Horizontal Type' ? 'd-none' : '' ?>" id="for-storey" >
                            <div class="form-group">
                                <label class="" for="">Storey Classification</label>
                                <select name="storey" class="form-control form-select @error('storey') is-invalid @enderror">
                                    <option value="">Select Storey Classification</option>
                                    <?php for ($i = 1; $i <= 100; $i++): ?>
                                    <option value="Storey <?php echo $i; ?>" <?php echo $details->category_type == "Storey $i" ? 'selected' : ''; ?>>
                                        Storey <?php echo $i; ?>
                                    </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div id="length_id" class="col-md-6 <?= $details->project_type == 'Vertical Type' ? 'd-none' : '' ?>" >
                            <div class="form-group">
                                <label class="" for="">Length / km</label>
                                <input type="text" value="<?= $details->category_type ?>" name="length" class="form-control @error('length') is-invalid @enderror">
                            </div>
                        </div>

                        <div class="col-md-6 " id="budget">
                            <div class="form-group">
                                <label for="">Overall/ Total Budget</label>
                                <input type="text" value="{{ number_format($details->total_budget, 2) }}" name="budget"
                                    class="form-control @error('budget') is-invalid @enderror">
                                @error('budget')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Start Date</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                    autocomplete="off" name="start_date" value="{{ $details->start_date }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                    autocomplete="off" name="end_date" value="{{ $details->end_date }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="control-label">Project Manager</label>
                                <select class="form-control select2 @error('manager_id') is-invalid @enderror"
                                    name="manager_id">
                                    <option value="">Select Project Manager</option>
                                    @forelse ($manager as $managers)
                                        <option value="{{ $managers->id }}"
                                            {{ $details->manager_id == $managers->id ? 'selected' : '' }}>
                                            {{ $managers->fullname }}</option>
                                    @empty
                                        <option value="">No Manager Account are Available</option>
                                    @endforelse

                                </select>
                                @error('manager_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="control-label">Project Owner</label>
                                <select class="form-control select2 @error('owner_id') is-invalid @enderror"
                                    name="owner_id">
                                    <option value="">Select Project Owner</option>
                                    @foreach ($owners as $owner)
                                        <option value="{{ $owner->id }}"
                                            {{ $details->project_owner == $owner->id ? 'selected' : '' }}>
                                            {{ $owner->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('owner_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Project Members</label>
                                <select class="form-control form-select @error('user_ids[]') is-invalid @enderror"
                                    multiple="multiple" name="user_ids[]" id="projectMembersSelect">
                                    <option value="">Select Project Members</option>
                                    @foreach ($members as $member)
                                        @php
                                            $selected = in_array($member->id, $projectMembers) ? 'selected' : '';
                                        @endphp
                                        <option value="{{ $member->id }}" {{ $selected }}>{{ $member->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_ids[]')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Description</label>
                                <textarea name="description" id="" cols="30" rows="3"
                                    class="summernote form-control @error('description') is-invalid @enderror">
                                    {{ $details->description }}
                                </textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @php
                            $detailsZone = unserialize($details->project_location_codes);
                        @endphp
                        <div class="col-md-6 mt-2">
                            <label for="" class="control-label">Project Location</label>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <select name="region" id="region"
                                            class="form-control form-select @error('region') is-invalid @enderror">
                                        </select>
                                        <input type="hidden" name="region_text" id="region-text">
                                        <input type="hidden" name="region_code" id="region-code">
                                        @error('region')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <select name="province" id="province"
                                            class="form-control form-select @error('province') is-invalid @enderror">

                                        </select>
                                        <input type="hidden" name="province_text" id="province-text">
                                        <input type="hidden" name="province_code" id="province-code">
                                        @error('province')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <select name="city" id="city"
                                            class="form-control form-select @error('city') is-invalid @enderror">

                                        </select>
                                        <input type="hidden" name="city_text" id="city-text">
                                        <input type="hidden" name="city_code" id="city-code">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <select name="barangay" id="barangay"
                                            class="form-control form-select @error('barangay') is-invalid @enderror">

                                        </select>
                                        <input type="hidden" name="barangay_text" id="barangay-text">
                                        <input type="hidden" name="barangay_code" id="barangay-code">
                                        @error('barangay')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="card-footer border-top border-info">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <button type="submit" class="btn btn-flat  bg-gradient-primary mx-2">Update Changes</button>
                    <a class="btn btn-flat  bg-gradient-warning mx-2" href="{{ route('admin.view-projects') }}">Discard Changes</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        var detailsZone = @json($detailsZone);
    </script>
    <script>
        $(function() {
            // events
            $('#region').on('change', my_handlers.fill_provinces);
            $('#province').on('change', my_handlers.fill_cities);
            $('#city').on('change', my_handlers.fill_barangays);
            $('#barangay').on('change', my_handlers.onchange_barangay);

            // load region
            let dropdown = $('#region');
            dropdown.empty();
            dropdown.append('<option selected="true" disabled>Choose Region</option>');
            dropdown.prop('selectedIndex', 0);
            const url = `/ph-json/region.json`;
            $.getJSON(url, function(data) {
                $.each(data, function(key, entry) {
                    dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
                })

                // Set selected region
                $('#region').val(detailsZone.region);
                // Trigger change event to fill provinces
                $('#region').change();
            });

            // Pre-fill provinces
            let provinceDropdown = $('#province');
            provinceDropdown.empty();
            provinceDropdown.append('<option selected="true" disabled>Choose Province</option>');
            provinceDropdown.prop('selectedIndex', 0);
            const provinceUrl = `/ph-json/province.json`;
            $.getJSON(provinceUrl, function(provinceData) {
                let provinceResult = provinceData.filter(function(value) {
                    return value.region_code == detailsZone.region;
                });
                $.each(provinceResult, function(key, entry) {
                    provinceDropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
                });

                // Set selected province
                $('#province').val(detailsZone.province);
                // Trigger change event to fill cities
                $('#province').change();
            });

            // Pre-fill cities
            let cityDropdown = $('#city');
            cityDropdown.empty();
            cityDropdown.append('<option selected="true" disabled>Choose City/Municipality</option>');
            cityDropdown.prop('selectedIndex', 0);
            const cityUrl = `/ph-json/city.json`;
            $.getJSON(cityUrl, function(cityData) {
                let cityResult = cityData.filter(function(value) {
                    return value.province_code == detailsZone.province;
                });
                $.each(cityResult, function(key, entry) {
                    cityDropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
                });
                $('#city').val(detailsZone.city);
                $('#city').change();
            });

            // Pre-fill barangays
            let barangayDropdown = $('#barangay');
            barangayDropdown.empty();
            barangayDropdown.append('<option selected="true" disabled>Choose Barangay</option>');
            barangayDropdown.prop('selectedIndex', 0);
            const barangayUrl = `/ph-json/barangay.json`;
            $.getJSON(barangayUrl, function(barangayData) {
                let barangayResult = barangayData.filter(function(value) {
                    return value.city_code == detailsZone.city;
                });
                $.each(barangayResult, function(key, entry) {
                    barangayDropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
                });

                // Set selected barangay
                $('#barangay').val(detailsZone.barangay);
            });
        });
    </script>
@endsection
