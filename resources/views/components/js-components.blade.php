<script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('templates/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('templates/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('templates/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('templates/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('templates/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('templates/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('templates/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('templates/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('templates/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('templates/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('templates/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('templates/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('templates/dist/js/pages/dashboard.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="{{ asset('templates/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('templates/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('templates/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('templates/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('templates/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('templates/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('templates/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('templates/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('templates/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('templates/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('templates/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('templates/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ asset('templates/dist/js/ph-location.js') }}"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:not(.no-export)'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible:not(.no-export)'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible:not(.no-export)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:not(.no-export)'
                    }
                },
                {
                    extend: 'colvis',
                    columns: ':not(.no-export)'
                }
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


    });
</script>


<script>
    $(function() {
        $("#example5").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:not(.no-export)'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible:not(.no-export)'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible:not(.no-export)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:not(.no-export)'
                    }
                },
                {
                    extend: 'colvis',
                    columns: ':not(.no-export)'
                }
            ]
        }).buttons().container().appendTo('#example5_wrapper .col-md-6:eq(0)');


    });
</script>


<script>
    $(function() {

        function getProjectManagerData() {
            return $.ajax({
                url: '/api/project-managers-data',
                method: 'GET',
                dataType: 'json',
            });
        }

        function initializeDoughnutChart(canvas, data, options) {
            new Chart(canvas, {
                type: 'doughnut',
                data: data,
                options: options
            });
        }
        getProjectManagerData().done(function(projectManagerData) {
            console.log('Project Manager Data:', projectManagerData);
            var labels = projectManagerData.map(manager => manager.manager_name);
            var data = projectManagerData.map(manager => manager.done_projects_count);
            var colors = projectManagerData.map(manager => manager.color);

            var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
            var donutData = {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                }]
            };
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };

            initializeDoughnutChart(donutChartCanvas, donutData, donutOptions);
        });


        //chart 2 best employee tasks accomplished

        function getEmployeeData() {
            return $.ajax({
                url: '/api/employee-data',
                method: 'GET',
                dataType: 'json',
            });
        }

        getEmployeeData().done(function(employeeData) {
            console.log('Employee Data:', employeeData);

            // Extracting relevant information for Chart.js
            var labels = employeeData.map(employee => employee.employee_name);
            var data = employeeData.map(employee => employee.done_tasks_count);
            var colors = employeeData.map(employee => employee.color);

            var donutChartCanvas = $('#donutChart1').get(0).getContext('2d');
            var donutData = {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                }]
            };
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };

            initializeDoughnutChart(donutChartCanvas, donutData, donutOptions);
        });
    })
</script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script> --}}
{{-- <script>
    $(document).ready(function() {
        $('#generateNewTableBtn').click(function() {
        var newHeaderText = $('#newHeaderText').val().trim(); // Get the new header text
        if (newHeaderText !== "") { // Check if user entered something
            var clonedTable = $('#first_table').clone(); // Clone the first table
            clonedTable.find('.text-primary').text(newHeaderText); // Set the new header text
            $('#multiple_table').append(clonedTable); // Append the cloned table below the existing tables
            $('#headerModal').modal('hide'); // Hide the modal
        }
    });
        function calculateGrandTotal() {
            var grandTotal = 0;
            $('.amount').each(function() {
                var amount = parseFloat($(this).val().replace(/,/g, '')) || 0; // Remove commas and parse as float
                grandTotal += amount;
            });
            $('#grand_total').val(grandTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // Format grand total with commas
        }

        function calculateRowTotal(row) {
            var qty = parseFloat(row.find('.qty').val()) || 0;
            var rate = parseFloat(row.find('.rate').val()) || 0;
            var rowTotal = qty * rate;
            row.find('.amount').val(rowTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // Format row total with commas
            return rowTotal;
        }

        function updateNumberField() {
            $('#product_tbody tr').each(function(index) {
                $(this).find('.number').val(index + 1);
            });
        }

        calculateGrandTotal();
        updateNumberField();

        $(document).on('input', '.qty, .rate', function() {
            var row = $(this).closest('tr');
            calculateRowTotal(row);
            calculateGrandTotal();
        });

        $('#btn-add-row').click(function() {
            var newRow = '<tr>' +
                '<td><input type="text" readonly name="number[]" class="form-control number"></td>' +
                '<td><input type="text" required name="description[]" class="form-control description"></td>' +
                '<td><input type="text" required name="qty[]" class="form-control qty"></td>' +
                '<td><input type="text" required name="unit[]" class="form-control unit"></td>' +
                '<td><input type="text" required name="rate[]" class="form-control rate"></td>' +
                '<td><input type="text" required name="amount[]" class="form-control amount"></td>' +
                '<td><input type="button" value="x" class="btn btn-danger btn-sm btn-row-remove"></td>' +
                '</tr>';
            $('#product_tbody').append(newRow);
            updateNumberField();
        });

        $(document).on('click', '.btn-row-remove', function() {
            $(this).closest('tr').remove();
            calculateGrandTotal();
            updateNumberField();
        });


    });
</script> --}}
<script>
    $('#project_type_dd').on('change', function() {
    var type = $(this).val();
    if (type === "Horizontal Type") {
        // If horizontal type, hide storey dropdown and show length input
        $('#for-storey').addClass('d-none');
        $('#for-length').removeClass('d-none');

        $('#selected_category_val')
            .empty()
            .append('<option value="Kalsada">Kalsada</option>')
            .append('<option value="Highway">Highway</option>')
            .append('<option value="Bridge">Bridge</option>');
    } else if (type === "Vertical Type") {
        // If vertical type, hide length input and show storey dropdown
        $('#for-storey').removeClass('d-none');
        $('#length_id').addClass('d-none');
        $('#for-length').addClass('d-none');
        $('#selected_category_val')
            .empty()
            .append('<option value="House">House</option>')
            .append('<option value="Condominium">Condominium</option>')
            .append('<option value="Apartment">Apartment</option>')
            .append('<option value="Government Facilities">Government Facilities</option>');

        var maxStoreys = 100;
        $('#storey-dropdown').empty();
        for (var i = 1; i <= maxStoreys; i++) {
            var optionText = i + ' Storey';
            var optionValue = 'Storey ' + i;
            $('#storey-dropdown').append('<option value="' + optionValue + '">' + optionText + '</option>');
        }
    }
});
</script>


<script>
    $(document).ready(function() {

        function initializeAddRowFunctionality(table) {

            function calculateGrandTotal() {
                var grandTotal = 0;
                table.find('.amount').each(function() {
                    var amount = parseFloat($(this).val().replace(/,/g, '')) ||
                    0;
                    grandTotal += amount;
                });
                table.find('#grand_total').val(grandTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g,
                ","));
            }


            function calculateRowTotal(row) {
                var qty = parseFloat(row.find('.qty').val()) || 0;
                var rate = parseFloat(row.find('.rate').val()) || 0;
                var rowTotal = qty * rate;
                row.find('.amount').val(rowTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g,
                ","));
                return rowTotal;
            }


            function updateNumberField() {
                table.find('#product_tbody tr').each(function(index) {
                    $(this).find('.number').val(index + 1);
                });
            }


            table.on('input', '.qty, .rate', function() {
                var row = $(this).closest('tr');
                calculateRowTotal(row);
                calculateGrandTotal();
            });


            table.find('#btn-add-row').click(function() {
                var newRow = '<tr>' +
                    '<td><input type="text" readonly name="number[]" class="form-control number"></td>' +
                    '<td><input type="text" required name="description[]" class="form-control description"></td>' +
                    '<td><input type="text" required name="qty[]" class="form-control qty"></td>' +
                    '<td><input type="text" required name="unit[]" class="form-control unit"></td>' +
                    '<td><input type="text" required name="rate[]" class="form-control rate"></td>' +
                    '<td><input type="text" required name="amount[]" class="form-control amount"></td>' +
                    '<td><input type="button" value="x" class="btn btn-danger btn-sm btn-row-remove"></td>' +
                    '</tr>';
                table.find('#product_tbody').append(newRow);
                updateNumberField();
            });


            table.on('click', '.btn-row-remove', function() {
                $(this).closest('tr').remove();
                calculateGrandTotal();
                updateNumberField();
            });


            calculateGrandTotal();
            updateNumberField();
        }


        initializeAddRowFunctionality($('#first_table'));


        $('#generateNewTableBtn').click(function() {
            var newHeaderText = $('#newHeaderText').val().trim();
            if (newHeaderText !== "") {
                var clonedTable = $('#first_table').clone();
                var newTableHeader = $('<h5 class="text-primary mt-2 table_name">' + newHeaderText +
                '</h5>');
                $('#multiple_table').append(newTableHeader);
                $('#multiple_table').append(
                clonedTable);
                initializeAddRowFunctionality(
                clonedTable);
                $('#headerModal').modal('hide');

                $('#newHeaderText').val('');

                $('#addNewTableBtn').remove();


                $('#multiple_table').append(
                    '<div class="d-flex float-right mt-3"><button type="button" class="btn btn-primary" id="addNewTableBtn" data-toggle="modal" data-target="#headerModal">Add New Table</button></div>'
                );
            }
        });

    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fetch data from your Laravel endpoint
        fetch('/api/vt')
            .then(response => response.json())
            .then(data => {
                var projectNames = data.map(item => item.project_name);
                var percentages = data.map(item => Math.min(item.totalPercentage, 100));
                var managerNames = data.map(item => item.manager_name);

                var ctx = document.getElementById('horizontalChart1').getContext('2d');
                var horizontalChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: projectNames,
                        datasets: [{
                            label: 'Project Completion (%)',
                            data: percentages,
                            backgroundColor: data.map(item => item.color),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: false
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    min: 0, // Minimum value for y-axis
                                    max: 100, // Maximum value for y-axis
                                    stepSize: 20 // Step size for y-axis
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                title: function(tooltipItem, data) {
                                    return data.labels[tooltipItem[0].index] + ' - ' + managerNames[tooltipItem[0].index];
                                }
                            }
                        }
                    }
                });

                // Add manager names to the bottom of the chart
                var chartContainer = document.getElementById('horizontalChart2').parentNode;

            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fetch data from your Laravel endpoint
        fetch('/api/hr')
            .then(response => response.json())
            .then(data => {
                var projectNames = data.map(item => item.project_name);
                var percentages = data.map(item => Math.min(item.totalPercentage, 100));
                var managerNames = data.map(item => item.manager_name);

                var ctx = document.getElementById('horizontalChart2').getContext('2d');
                var horizontalChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: projectNames,
                        datasets: [{
                            label: 'Project Completion (%)',
                            data: percentages,
                            backgroundColor: data.map(item => item.color),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: false
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    min: 0, // Minimum value for y-axis
                                    max: 100, // Maximum value for y-axis
                                    stepSize: 20 // Step size for y-axis
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                title: function(tooltipItem, data) {
                                    return data.labels[tooltipItem[0].index] + ' - ' + managerNames[tooltipItem[0].index];
                                }
                            }
                        }
                    }
                });

                // Add manager names to the bottom of the chart
                var chartContainer = document.getElementById('horizontalChart2').parentNode;

            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>



{{-- <script>
    $(document).ready(function() {
        function saveToExcel() {
            var wb = XLSX.utils.book_new();

            var data = [];
            $('#product_tbody tr').each(function() {
                var rowData = [];
                $(this).find('input[type="text"]').each(function() {
                    rowData.push($(this).val());
                });
                data.push(rowData);
            });

            var ws = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

            var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

            var blob = new Blob([s2ab(wbout)], { type: 'application/octet-stream' });
            var url = URL.createObjectURL(blob);
            var a = document.createElement("a");
            document.body.appendChild(a);
            a.style = "display: none";
            a.href = url;
            a.download = "data.xlsx";

            a.click();

            window.URL.revokeObjectURL(url);
        }
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }

        $('form').submit(function(event) {
            event.preventDefault();
            saveToExcel();
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
        $('#pdfForm').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route('admin.print-pdf') }}',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                success: function(response) {
                    console.log(response)
                    // var blob = new Blob([response], { type: 'application/pdf' });
                    // var link = document.createElement('a');
                    // link.href = window.URL.createObjectURL(blob);
                    // link.download = 'bill_of_quantities.pdf';
                    // link.click();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
