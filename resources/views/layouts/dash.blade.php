<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>@yield('title')</title>

  <!-- Favicons -->
  {{-- <link href="{{asset('dash/img/favicon.png')}}" rel="icon">
  <link href="{{asset('dash/img/apple-touch-icon.png')}}" rel="apple-touch-icon"> --}}

  <!-- Bootstrap core CSS -->
  <link href="{{asset('dash/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!--external css-->
  <link href="{{asset('dash/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{asset('dash/css/zabuto_calendar.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('dash/lib/gritter/css/jquery.gritter.css')}}" />
  <!-- Custom styles for this template -->
  <link href="{{asset('dash/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('dash/css/style-responsive.css')}}" rel="stylesheet">
  <script src="{{asset('dash/lib/chart-master/Chart.js')}}"></script>
  @yield('styles')
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right"></div>
      </div>
      <!--logo start-->
      <a href="{{route('welcome')}}" class="logo"><b>GALL<span>ERY</span></b></a>
      <!--logo end-->
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li>
            <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">LOGOUT</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered">
            @if(auth()->user()->avatar=='')
              <img src="/storage/avatar/avatar.webp" class="img-circle" width="80">
            @else
              <img src="/storage/{{auth()->user()->avatar}}" class="img-circle" width="80">
            @endif
          </p>
          <h5 class="centered">{{auth()->user()->name}}</h5>
          <li class="mt">
            <a href="{{route('home')}}">
              <i class="fa fa-home"></i>
              <span>Home</span>
              </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-users"></i>
              <span>Users</span>
              </a>
            <ul class="sub">
              <li><a href="{{route('users.index')}}">Show users</a></li>
              <li><a href="{{route('users.index')}}">Add admins</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-list-ul"></i>
              <span>Categories</span>
              </a>
            <ul class="sub">
              <li><a href="{{route('categories.index')}}">Show all categories</a></li>
              <li><a href="{{route('categories.create')}}">Add categories</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-tags"></i>
              <span>Tags</span>
              </a>
            <ul class="sub">
              <li><a href="{{route('tags.index')}}">Show all tags</a></li>
              <li><a href="{{route('tags.create')}}">Add tags</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-photo"></i>
              <span>Posts</span>
              </a>
            <ul class="sub">
              <li><a href="{{route('posts.index')}}">Shared posts</a></li>
              <li><a href="{{route('trashed.index')}}">Trashed posts</a></li>
              <li><a href="{{route('posts.create')}}">Add posts</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="{{route('user.edit')}}">
              <i class="fa fa-user"></i>
              <span>Edit profile</span>
              </a>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>

    <section id="main-content">
      <section class="wrapper">
            @yield('content')
      </section>
    </section>
    
        
        
        
        <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{asset('dash/lib/jquery/jquery.min.js')}}"></script>

  <script src="{{asset('dash/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{asset('dash/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{asset('dash/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('dash/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <script src="{{asset('dash/lib/jquery.sparkline.js')}}"></script>
  <!--common script for all pages-->
  <script src="{{asset('dash/lib/common-scripts.js')}}"></script>
  <script type="text/javascript" src="{{asset('dash/lib/gritter/js/jquery.gritter.js')}}"></script>
  <script type="text/javascript" src="{{asset('dash/lib/gritter-conf.js')}}"></script>
  <!--script for this page-->
  <script src="{{asset('dash/lib/sparkline-chart.js')}}"></script>
  <script src="{{asset('dash/lib/zabuto_calendar.js')}}"></script>
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
  @yield('scripts')
</body>

</html>