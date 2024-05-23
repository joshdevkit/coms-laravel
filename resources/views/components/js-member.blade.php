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

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>


<script>
    $(function() {
        $("#example2").DataTable({
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

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
