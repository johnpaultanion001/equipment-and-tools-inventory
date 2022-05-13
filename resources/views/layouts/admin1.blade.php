
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets_admin/img/apple-icon.png') }}">
 
  <link rel="icon" href="https://ssl.gstatic.com/atari/images/public/favicon.ico">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    {{ trans('panel.site_title') }}
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/e64ab92996.js" crossorigin="anonymous"></script>

    <!-- Font Awesome Icons -->
    <script src="https://use.fontawesome.com/5882f93e19.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/icons/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/icons/css/solid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/icons/css/all.css') }}">
  <!-- CSS Files -->
  <link  href="{{ asset('assets_admin/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets_admin/css/now-ui-kit.css?v=1.3.0') }}" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('assets_admin/demo/demo.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <!-- datatables -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />


  <style>
      .form-control[readonly] {
        background-color: whitesmoke;
        font-weight: bold;
      }
      .form-control{
        font-weight: bold;
      }
      .select2{
        color: black;
        font-weight: bold;
      }
      .active{
          font-weight: bold;
          border-bottom: solid white 1px;
      }
      .scrollable{
        overflow-y: auto;
        max-height: 600px;
      }
      .pac-container { z-index: 100000 !important; }
      
      .invalid-feedback {
            font-size: 100%;
        }
    .input-group-append{
        background-color: transparent;
        border-top: solid 1px #111;
        border-right: solid 1px #111;
        border-bottom: solid 1px #111;
        color: #2c2c2c;
    }
     
  </style>
  @yield('styles')
</head>

<body class="index-page sidebar-collapse">
  <div class="background">
    @include('partials.admin.navbar')
    <div class="wrapper">
        <div class="main">
        
        <div class="row">
              <div id="success-alert" class="col-4 alert text-white fade show fixed-top mt-4" data-dismiss="alert" style="margin-left: 65%; z-index: 9999;" role="alert"></div>
          </div>
          @yield('content')
          
        </div>
        
    </div>
  </div>

  <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>

  

  <!--   Core JS Files   -->
 
  <script src="{{ asset('/assets_admin/js/core/jquery.min.js') }}" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <script src="{{ asset('/assets_admin/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/assets_admin/js/plugins/bootstrap-datepicker.js') }}" type="text/javascript"></script>



  <script src="{{ asset('/assets_admin/js/core/popper.min.js') }}" type="text/javascript"></script>
 

  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script   src="{{ asset('/assets_admin/js/plugins/bootstrap-switch.js') }}"></script>


  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
 
  <script src="{{ asset('/assets_admin/js/now-ui-kit.js?v=1.3.0') }}" type="text/javascript"></script>


    <!-- jquery script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

     <!-- datatables -->
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
            
        
       
        <script>
            $(document).ready(function () {
                $('.select2').select2()
            
            });
    
        </script>


    
    <script>
        $(function() {
            let copyButtonTrans = 'COPY'
            let csvButtonTrans = 'EXCEL'
            let excelButtonTrans = 'EXCEL'
            let pdfButtonTrans = 'PDF'
            let printButtonTrans = 'PRINT'
            let colvisButtonTrans = 'VIEW'

            let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn btn-sm m-2 btn-primary' })
            $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: languages['{{ app()->getLocale() }}']
            },
            
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [
                {
                extend: 'copy',
                className: 'btn-warning btn-sm mt-1 mb-1 copies',
                text: copyButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                extend: 'csv',
                className: 'btn-warning btn-sm mt-1 mb-1',
                text: csvButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                extend: 'excel',
                className: 'btn-warning btn-sm mt-1 mb-1',
                text: excelButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                extend: 'pdf',
                className: 'btn-warning btn-sm mt-1 mb-1',
                text: pdfButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                    extend: 'print',
                    className: 'btn-warning btn-sm mt-1 mb-1',
                    titleAttr: 'Click this print',
                    text: printButtonTrans,
                    exportOptions: {
                    columns: ':visible'
                    },

                },
                {
                extend: 'colvis',
                className: 'btn-warning btn-sm mt-1 mb-1',
                text: colvisButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                
                }
            ]
            });
            $.fn.dataTable.ext.classes.sPageButton = '';
        });
    </script>
    
    
    @yield('scripts')
    
</body>

</html>