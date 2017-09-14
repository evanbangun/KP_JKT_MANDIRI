
<!DOCTYPE html>
<html class="" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="admin-themes-lab">
  <meta name="author" content="themes-lab">
  <link rel="shortcut icon" href="/images/favicon.png" type="image/png">
  <title>@yield('title')</title>
  <link href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet" type="text/css">
  <link href="/plugins/datatables/dataTables.min.css" rel="stylesheet">
  <link href="/page-builder/plugins/slider-pips/jquery-ui-slider-pips.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet"> <!-- MANDATORY -->
  <link href="/css/theme.css" rel="stylesheet"> <!-- MANDATORY -->
  <link href="/css/ui.css" rel="stylesheet"> <!-- MANDATORY -->

</head>
<body class="fixed-topbar submenu-hover color-default theme-sltl bg-lighter">
  <section>
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar">
        <div>
          <h1><a href="/dashboard">&nbsp;</a></h1>
        </div>
        <div class="sidebar-inner">
          <div class="sidebar-top">
            <div class="userlogged clearfix">
              <i class="icon icons-faces-users-01"></i>
              <div class="user-details">
                <h4 class="">{{session('name')}}</h4>
              </div>
            </div>
          </div>
          <div class="menu-title">
            <span>MAIN MENU</span>
          </div>
          <ul class="nav nav-sidebar">
            <li class="tm"><a href="/home"><span>Home</span></a></li>
            <li class="tm nav-parent "><a ><span>Daftar Tape</span></a>
              <ul class="children collapse">
                <li class=""><a href="/tape">Terpakai</a></li>
                <li class=""><a href="/tapekosong">Kosong</a></li>
              </ul>
            </li>
            @if(session('role') != 2)
            <li class="tm nav-parent active"><a ><span>Peminjaman</span></a>
              <ul class="children collapse">  
                <li class=""><a href="/daftartiket">List Ticket</a></li>
                @if(session('role') != 1)
                <li class=""><a href="/tambahtiket">Buat Ticket</a></li>
                @endif
                <li class=""><a href="/openticket">Daftar New Ticket</a></li>
                @if(session('role') != 1)
                <li class=""><a href="/daftardeliver">Daftar On Delivery </a></li>
                @endif
                @if(session('role') != 1)
                <li class=""><a href="/daftarrestore">Daftar Restoring </a></li>
                @endif
                @if(session('role') != 3)
                <li class=""><a href="/daftardone">Daftar Done Ticket</a></li>
                @endif
                @if(session('role') != 3)
                <li class=""><a href="/daftarclose">Daftar Closed Ticket</a></li>
                @endif
                <li class=""><a href="/overdueticket">Over Due Ticket</a></li>
              </ul>
            </li>
            @endif
            <li class="tm nav-parent"><a ><span>Detail</span></a>
              <ul class="children collapse">  
                <li class=""><a href="/daftarlokasi">Lokasi</a></li>
                <li class=""><a href="/daftarrak">Rak</a></li>
                <li class=""><a href="/daftarjenistape">Tape</a></li>
              </ul>
            </li>
            <li class="tm nav-parent"><a ><span>Activity</span></a>
              <ul class="children collapse">  
                @if(session('role') != 2)
                <li class=""><a href="/stockopname">Stock Opname</a></li>
                <li class=""><a href="/movingtape">Moving Tape</a></li>
                @endif
                <li class=""><a href="/testingtape">Testing Tape</a></li>
              </ul>
            </li>
            <li class="tm "><a href="/audittrail"><span>Audit Trail</span></a>
            </li>
            @if(session('role') == 0)
            <li ><a href="/manageuser"><span>Manage User</span></a>
            </li>
            @endif
          </ul>
          
          <div class="sidebar-widgets"></div>
          <div class="sidebar-footer clearfix" style="">
            <a class="pull-left btn-effect" href="/logout" data-original-title="Logout"><i class="icon-power"></i></a>
          </div>
        </div>
      </div>
      <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
          <div class="topnav">
          </div>
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="custom-page" style="@media print{ overflow: hidden;}">
              <!-- Content Header (Page header) -->
              <section class="content-header">

                <ol class="breadcrumb" style="margin:0px;">
                  <li><a href="#"></i>@yield('smallcontent-header')</a></li>
                </ol>
                <h1 style="margin-top:.3em;">
                  <b id="title"><strong>@yield('content-header')</strong></b>
                  <small class="sm-header"></small>
                </h1>
              </section>

              @yield('content')
          </div>
          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset"> <span>Copyright <span class="copyright">©</span> 2017 </span> <span>TEST</span>. <span>All rights reserved. </span> </p>
            </div>
          </div>
    
        <!-- END PAGE CONTENT -->
        
      <!-- END PAGE CONTENT -->
      </div>
      
      <!-- END MAIN CONTENT -->
    </section>

<script src="/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="/plugins/jquery/jquery-migrate-3.0.0.min.js"></script>
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/plugins/gsap/main-gsap.min.js"></script> <!-- HTML Animations -->
<script src="/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
<script src="/plugins/bootbox/bootbox.min.js"></script>
<script src="/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
<script src="/plugins/tether/js/tether.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
<script src="/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
<script src="/plugins/switchery/switchery.min.js"></script> <!-- IOS Switch -->
<script src="/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
<script src="/plugins/retina/retina.min.js"></script>  <!-- Retina Display -->
<script src="/plugins/jquery-cookies/jquery.cookies.js"></script> <!-- Jquery Cookies, for theme -->
<script src="/plugins/bootstrap/js/jasny-bootstrap.min.js"></script> <!-- File Upload and Input Masks -->
<script src="/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
<script src="/plugins/bootstrap-tags-input/bootstrap-tagsinput.min.js"></script> <!-- Select Inputs -->
<script src="/plugins/bootstrap-loading/lada.min.js"></script> <!-- Buttons Loading State -->
<script src="/plugins/timepicker/jquery-ui-timepicker-addon.min.js"></script> <!-- Time Picker -->
<script src="/plugins/multidatepicker/multidatespicker.min.js"></script> <!-- Multi dates Picker -->
<script src="/plugins/colorpicker/spectrum.min.js"></script> <!-- Color Picker -->
<script src="/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script> <!-- A mobile and touch friendly input spinner component for Bootstrap -->
<script src="/plugins/autosize/autosize.min.js"></script> <!-- Textarea autoresize -->
<script src="/plugins/icheck/icheck.min.js"></script> <!-- Icheck -->
<script src="/plugins/bootstrap-editable/js/bootstrap-editable.min.js"></script> <!-- Inline Edition X-editable -->
<script src="/plugins/bootstrap-context-menu/bootstrap-contextmenu.min.js"></script> <!-- File Upload and Input Masks -->
<script src="/plugins/prettify/prettify.min.js"></script> <!-- Show html code -->
<script src="/plugins/slick/slick.min.js"></script> <!-- Slider -->
<script src="/plugins/countup/countUp.min.js"></script> <!-- Animated Counter Number -->
<script src="/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
<script src="/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
<script src="/plugins/charts-chartjs/Chart.min.js"></script>  <!-- ChartJS Chart -->
<script src="/plugins/bootstrap-slider/bootstrap-slider.js"></script> <!-- Bootstrap Input Slider -->
<script src="/plugins/visible/jquery.visible.min.js"></script> <!-- Visible in Viewport -->
<script src="/js/builder.js"></script>
<script src="/js/sidebar_hover.js"></script>
<script src="/js/application.js"></script> <!-- Main Application Script -->
<script src="/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
<script src="/js/widgets/notes.js"></script>
<script src="/js/quickview.js"></script> <!-- Quickview Script -->
<script src="/js/pages/search.js"></script> <!-- Search Script -->
<!-- BEGIN PAGE SCRIPTS -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="/plugins/summernote/summernote.js"></script>
<script src="/plugins/skycons/skycons.js"></script>
<script src="/plugins/simple-weather/jquery.simpleWeather.min.js"></script>
<script src="/js/widgets/widget_weather.js"></script>
<script src="/js/widgets/todo_list.js"></script>
<script src="/page-builder/plugins/slider-pips/jquery-ui-slider-pips.min.js"></script>
<script src="/page-builder/plugins/saveas/saveAs.js"></script>
<script src="/page-builder/js/builder_page.js"></script>
<!-- END PAGE SCRIPTS -->
</body>
</html>