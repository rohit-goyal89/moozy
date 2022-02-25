<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo  url('/'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo  url('/'); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo  url('/'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo  url('/'); ?>/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo  url('/'); ?>/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="<?php echo  url('/'); ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo  url('/'); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.class">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo  url('/'); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo  url('/'); ?>/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo  url('/'); ?>/plugins/summernote/summernote-bs4.min.css"
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .required label {
            font-weight: bold;
        }
        .required label:after {
            color: #e32;
            content: ' *';
            display:inline;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>@lang('auth.app.member_since') {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            @lang('auth.sign_out')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <!--<div class="float-right d-none d-sm-block">
            <b>Version</b> 3.1.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved. -->
    </footer>
</div>


<!-- jQuery -->
<script src="<?php echo  url('/'); ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo  url('/'); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo  url('/'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo  url('/'); ?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo  url('/'); ?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo  url('/'); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo  url('/'); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo  url('/'); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo  url('/'); ?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo  url('/'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo  url('/'); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo  url('/'); ?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- Summernote -->
<script src="<?php echo  url('/'); ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo  url('/'); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo  url('/'); ?>/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo  url('/'); ?>/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo  url('/'); ?>/dist/js/pages/dashboard.js"></script>
<script src="<?php echo  url('/'); ?>/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo  url('/'); ?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!--<script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>-->


<script>
    $(function () {
       // bsCustomFileInput.init();
    });

    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>
<script>
  $(function() {
    $('.js-example-basic-multiple').select2();

    $('.datepicker').datetimepicker({ 
        format: 'DD/MM/YYYY'
    }); 

    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
    $(".time").blur(function(){
      var timestring = ($(this).val()).split(":");
      var res ='';
      if(timestring[1]){
         res = leftPad(timestring[0], 2) +':'+leftPad(timestring[1], 2);
      } else {
         res = leftPad(timestring[0], 2) +':00';
      }
      $(this).val(res);
    })
    $(".add_manage_store").click(function(){
        if($("#day").val() != "" && $("#open_time").val() != "" && $("#closing_time").val() != "") {
          if( $("#manage_store_time tr").length <=7) {
            var appendCnt = $("#manage_store_time tr").length -1;
            console.log(appendCnt);
            var html = '<tr><input type="hidden" name="manage_restaurant['+appendCnt+'][day]" value="'+$("#day").val()+'"><input type="hidden" name="manage_restaurant['+appendCnt+'][open_time]" value="'+$("#open_time").val()+'"><input type="hidden" name="manage_restaurant['+appendCnt+'][close_time]" value="'+$("#closing_time").val()+'"><td>'+$("#day option:selected").text()+'</td><td>'+$("#open_time").val()+'</td><td>'+$("#closing_time").val()+'</td></tr>';
            $("#manage_store_time").append(html);
          } else {
              alert("You can add upto 7 days manage restaurant.");
          }
          
        } else {
          alert("Please select day, open time, closing time of restaurant.");
        }
    });

    $(".add_submenu").click(function(){
        if($("#submenu").val() != "" && $("#sub_price").val() != "") {
            var appendCnt = $("#manage_menu_store tr").length -1;
            console.log(appendCnt);
            var html = '<tr><input type="hidden" name="manage_menu['+appendCnt+'][name]" value="'+$("#submenu").val()+'"><input type="hidden" name="manage_menu['+appendCnt+'][price]" value="'+$("#sub_price").val()+'"><td>'+$("#submenu").val()+'</td><td>'+$("#sub_price").val()+'</td><td><a href="javascript:void(0)" class="delete_sub_menu" data-id="0"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
            $("#manage_menu_store").append(html);
          
        } else {
          alert("Please select price and submenu of menu.");
        }
    });
$('body').on('click', '.delete_sub_menu', function () {
      var result = confirm("Are you sure you want to delete this item?");
      if (result) {
         let item_id=$(this).data('id');
         if(item_id>0) {
           $.ajax({
             url:"<?php echo url('/') ?>/submenu/delete",
             type: "Get",
             data:{item_id:item_id},
             success: function (data) {
                    
                    $(this).parent().closest('tr').remove();
              },
           })
         }
         $(this).parent().closest('tr').remove();
      }

    })
  })
  function leftPad(number, targetLength) {
    var output = number + '';
    while (output.length < targetLength) {
        output = '0' + output;
    }
    return output;
}

  $(document).ready(function() {
        var url = window.location; 
        var element = $('ul.sidebar-menu a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0; }).parent().addClass('active');
        if (element.is('li')) { 
             element.addClass('active').parent().parent('li').addClass('active')
         }
    });

</script>

<script>
    // CKEDITOR.replace('editor', {
    //   fullPage: true,
    //   extraPlugins: 'docprops',
    //   allowedContent: true,
    //   height: 320,
    //   removeButtons: 'PasteFromWord'
    // });
    // CKEDITOR.replace('editor1', {
    //   fullPage: true,
    //   extraPlugins: 'docprops',
    //   allowedContent: true,
    //   height: 320,
    //   removeButtons: 'PasteFromWord'
    // });
  </script>
</body>
</html>
