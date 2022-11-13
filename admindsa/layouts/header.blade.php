
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"> --}}

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datepicker/date-picker.css')}}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css' )}}"/>
{{-- 
    <link rel="stylesheet" href="{{asset('assets/vendor/css/bootstrap.css')}}"/> --}}
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatable/datatables/datatables.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweet-alert/sweetalert2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/evo-calendar/css/evo-calendar.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datepicker/date-picker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datepicker/daterange-picker.css')}}">
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
    <style>
      .paginate_button .current{
        color: var(--bs-blue) !important;
      }
      .datepicker--nav-action{
        background-color: rgb(105,108,255);
      }
      .datepicker--nav-action :hover{
        background-color: rgb(105,108,255);
      }
      .datepicker--cell .datepicker--cell-day .-selected-{
        background-color: rgb(105,108,255);
      }
    </style>