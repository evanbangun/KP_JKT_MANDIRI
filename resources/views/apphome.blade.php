<!DOCTYPE html>



  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
 <!-- Bootstrap Core Css -->
    <link href="/plugins3/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="/plugins3/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="/plugins3/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="/plugins3/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="/css3/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css3/themes/all-themes.css" rel="stylesheet" />

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
<style type="text/css">
  html, body{
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  font-family: 'Open Sans', sans-serif;
}

a{
  text-decoration: none;
}

p, li, a{
  font-size: 14px;
}

/* GRID */

.twelve { width: 100%; }
.eleven { width: 91.53%; }
.ten { width: 83.06%; }
.nine { width: 74.6%; }
.eight { width: 66.13%; }
.seven { width: 57.66%; }
.six { width: 49.2%; }
.five { width: 40.73%; }
.four { width: 32.26%; }
.three { width: 23.8%; }
.two { width: 15.33%; }
.one { width: 6.866%; }

/* COLUMNS */

.col {
  display: block;
  float:left;
  margin: 1% 0 1% 1.6%;
}

.col:first-of-type {
  margin-left: 0;
}

.container{
  width: 100%;
  max-width: 940px;
  margin: 0 auto;
  position: relative;
  text-align: center;
}

/* CLEARFIX */

.cf:before,
.cf:after {
    content: " ";
    display: table;
}

.cf:after {
    clear: both;
}

.cf {
    *zoom: 1;
}

/* ALL */

.row .three{
  padding: 80px 30px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  background-color: #06B7F9  ;
  color: #ecf0f1;
  text-align: center;
}

.hamburger .line{

  
  
  font-family: fantasy;
  font-weight: bold;
}

.hamburger:hover{
  cursor: pointer;
}

/* ONE */

#hamburger-1.is-active .line:nth-child(2){
  opacity: 0;
}

#hamburger-1.is-active .line:nth-child(1){
  -webkit-transform: translateY(13px) rotate(45deg);
  -ms-transform: translateY(13px) rotate(45deg);
  -o-transform: translateY(13px) rotate(45deg);
  transform: translateY(13px) rotate(45deg);
}

#hamburger-1.is-active .line:nth-child(3){
  -webkit-transform: translateY(-13px) rotate(-45deg);
  -ms-transform: translateY(-13px) rotate(-45deg);
  -o-transform: translateY(-13px) rotate(-45deg);
  transform: translateY(-13px) rotate(-45deg);
}

/* TWO */

#hamburger-2.is-active .line:nth-child(1){
  -webkit-transform: translateY(13px);
  -ms-transform: translateY(13px);
  -o-transform: translateY(13px);
  transform: translateY(13px);
}

#hamburger-2.is-active .line:nth-child(3){
  -webkit-transform: translateY(-13px);
  -ms-transform: translateY(-13px);
  -o-transform: translateY(-13px);
  transform: translateY(-13px);
}

/* THREE */

#hamburger-3.is-active .line:nth-child(1),
#hamburger-3.is-active .line:nth-child(3){
  width: 40px;
}

#hamburger-3.is-active .line:nth-child(1){
  -webkit-transform: translateX(-10px) rotate(-45deg);
  -ms-transform: translateX(-10px) rotate(-45deg);
  -o-transform: translateX(-10px) rotate(-45deg);
  transform: translateX(-10px) rotate(-45deg);
}

#hamburger-3.is-active .line:nth-child(3){
  -webkit-transform: translateX(-10px) rotate(45deg);
  -ms-transform: translateX(-10px) rotate(45deg);
  -o-transform: translateX(-10px) rotate(45deg);
  transform: translateX(-10px) rotate(45deg);
}

/* FOUR */

#hamburger-4.is-active .line:nth-child(1),
#hamburger-4.is-active .line:nth-child(3){
  width: 40px;
}

#hamburger-4.is-active .line:nth-child(1){
  -webkit-transform: translateX(10px) rotate(45deg);
  -ms-transform: translateX(10px) rotate(45deg);
  -o-transform: translateX(10px) rotate(45deg);
  transform: translateX(10px) rotate(45deg);
}

#hamburger-4.is-active .line:nth-child(3){
  -webkit-transform: translateX(10px) rotate(-45deg);
  -ms-transform: translateX(10px) rotate(-45deg);
  -o-transform: translateX(10px) rotate(-45deg);
  transform: translateX(10px) rotate(-45deg);
}

/* FIVE */

#hamburger-5.is-active{
  -webkit-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}

#hamburger-5.is-active .line:nth-child(2){
  -webkit-transition: none;
  -o-transition: none;
  transition: none;
}

#hamburger-5 .line:nth-child(2){
  -webkit-transition-delay: 0.3s;
  -o-transition-delay: 0.3s;
  transition-delay: 0.3s;
}


#hamburger-5.is-active .line:nth-child(2){
  opacity: 0;
}

#hamburger-5.is-active .line:nth-child(1),
#hamburger-5.is-active .line:nth-child(3){
  width: 35px;
  -webkit-transform-origin: right;
  -moz-transform-origin: right;
  -ms-transform-origin: right;
  -o-transform-origin: right;
  transform-origin: right;
}

#hamburger-5.is-active .line:nth-child(1){
  -webkit-transform: translateY(15px) rotate(45deg);
  -ms-transform: translateY(15px) rotate(45deg);
  -o-transform: translateY(15px) rotate(45deg);
  transform: translateY(15px) rotate(45deg);
}

#hamburger-5.is-active .line:nth-child(3){
  -webkit-transform: translateY(-15px) rotate(-45deg);
  -ms-transform: translateY(-15px) rotate(-45deg);
  -o-transform: translateY(-15px) rotate(-45deg);
  transform: translateY(-15px) rotate(-45deg);
}

/* SIX */

#hamburger-6.is-active{
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  -webkit-transition-delay: 0.6s;
  -o-transition-delay: 0.6s;
  transition-delay: 0.6s;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
}

#hamburger-6.is-active .line:nth-child(2){
  width: 0px;
}

#hamburger-6.is-active .line:nth-child(1),
#hamburger-6.is-active .line:nth-child(3){
  -webkit-transition-delay: 0.3s;
  -o-transition-delay: 0.3s;
  transition-delay: 0.3s;
}

#hamburger-6.is-active .line:nth-child(1){
  -webkit-transform: translateY(13px);
  -ms-transform: translateY(13px);
  -o-transform: translateY(13px);
  transform: translateY(13px);
}

#hamburger-6.is-active .line:nth-child(3){
  -webkit-transform: translateY(-13px) rotate(90deg);
  -ms-transform: translateY(-13px) rotate(90deg);
  -o-transform: translateY(-13px) rotate(90deg);
  transform: translateY(-13px) rotate(90deg);
}

/* SEVEN */

#hamburger-7.is-active .line:nth-child(1){
  width: 30px;
}

#hamburger-7.is-active .line:nth-child(2){
  width: 40px;
}

#hamburger-7.is-active .line{
  -webkit-transform: rotate(30deg);
  -ms-transform: rotate(30deg);
  -o-transform: rotate(30deg);
  transform: rotate(30deg);
}

/* EIGHT */

#hamburger-8.is-active .line:nth-child(2){
  opacity: 0;
}

#hamburger-8.is-active .line:nth-child(1){
  -webkit-transform: translateY(13px);
  -ms-transform: translateY(13px);
  -o-transform: translateY(13px);
  transform: translateY(13px);
}

#hamburger-8.is-active .line:nth-child(3){
  -webkit-transform: translateY(-13px) rotate(90deg);
  -ms-transform: translateY(-13px) rotate(90deg);
  -o-transform: translateY(-13px) rotate(90deg);
  transform: translateY(-13px) rotate(90deg);
}

/* NINE */

#hamburger-9{
  position: relative;
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

#hamburger-9.is-active{
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
}

#hamburger-9:before{
  content: "";
  position: absolute;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  width: 70px;
  height: 70px;
  border: 5px solid transparent;
  top: calc(50% - 35px);
  left: calc(50% - 35px);
  border-radius: 100%;
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

#hamburger-9.is-active:before{
  border: 5px solid #ecf0f1;
}

#hamburger-9.is-active .line{
  width: 35px;
}

#hamburger-9.is-active .line:nth-child(2){
  opacity: 0;
}

#hamburger-9.is-active .line:nth-child(1){
  -webkit-transform: translateY(13px);
  -ms-transform: translateY(13px);
  -o-transform: translateY(13px);
  transform: translateY(13px);
}

#hamburger-9.is-active .line:nth-child(3){
  -webkit-transform: translateY(-13px) rotate(90deg);
  -ms-transform: translateY(-13px) rotate(90deg);
  -o-transform: translateY(-13px) rotate(90deg);
  transform: translateY(-13px) rotate(90deg);
}

/* TEN */

#hamburger-10{
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

#hamburger-10.is-active{
  -webkit-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}

#hamburger-10.is-active .line:nth-child(1){
  width: 30px
}

#hamburger-10.is-active .line:nth-child(2){
  width: 40px
}

/* ELEVEN */

#hamburger-11{
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

#hamburger-11.is-active{
  animation: smallbig 0.6s forwards;
}

@keyframes smallbig{
  0%, 100%{
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
  }

  50%{
    -webkit-transform: scale(0);
    -ms-transform: scale(0);
    -o-transform: scale(0);
    transform: scale(0);
  }
}

#hamburger-11.is-active .line:nth-child(1),
#hamburger-11.is-active .line:nth-child(2),
#hamburger-11.is-active .line:nth-child(3){
  -webkit-transition-delay: 0.2s;
  -o-transition-delay: 0.2s;
  transition-delay: 0.2s;
}

#hamburger-11.is-active .line:nth-child(2){
  opacity: 0;
}

#hamburger-11.is-active .line:nth-child(1){
  -webkit-transform: translateY(13px) rotate(45deg);
  -ms-transform: translateY(13px) rotate(45deg);
  -o-transform: translateY(13px) rotate(45deg);
  transform: translateY(13px) rotate(45deg);
}

#hamburger-11.is-active .line:nth-child(3){
  -webkit-transform: translateY(-13px) rotate(-45deg);
  -ms-transform: translateY(-13px) rotate(-45deg);
  -o-transform: translateY(-13px) rotate(-45deg);
  transform: translateY(-13px) rotate(-45deg);
}

/* TWELVE */

#hamburger-12.is-active .line:nth-child(1){
  opacity: 0;
  -webkit-transform: translateX(-100%);
  -ms-transform: translateX(-100%);
  -o-transform: translateX(-100%);
  transform: translateX(-100%);
}

#hamburger-12.is-active .line:nth-child(3){
  opacity: 0;
  -webkit-transform: translateX(100%);
  -ms-transform: translateX(100%);
  -o-transform: translateX(100%);
  transform: translateX(100%);
}
  
</style>
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
            <span>Tape Management Mandiri</span>
          </div>
          
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