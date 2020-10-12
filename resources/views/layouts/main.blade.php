<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="SamVwede General Ticketing System App" />
    <meta name="author" content="Eshemiedomi Samuel Oghenevwede" />
    <meta name="email" content="eshemiedomisamuelb@gmail.com" />
    <title> SamVwede Ticketing System </title>
	<!-- icons -->
    <link href="{{ asset('assets/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
	<!--bootstrap -->
	<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/material/material.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/material_style.css') }}">
	<!-- animation -->
	<link href="{{ asset('assets/css/pages/animate_page.css') }}" rel="stylesheet">
	<!-- Template Styles -->
    <link href="{{ asset('assets/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/theme-color.css') }}" rel="stylesheet" type="text/css" />
	
 </head>
 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <div class="page-logo">
                    <a href="/">
                      <span class="logo-default" > {{ $org_info->exists ? $org_info->name : " Organization Name Not Set "  }} </span> 
                    </a>
                </div>
                <!-- logo end -->
				<ul class="nav navbar-nav navbar-left in">
					<li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
				</ul>
                <!-- start mobile menu -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
               <!-- end mobile menu -->
                <!-- start header menu -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
 						<!-- start manage user dropdown -->
 						<li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle " src="{{ asset('assets/img/dp.jpg') }}" />
                                <span class="username"> {{ Auth::user()->name }} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default animated jello">
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">
                                        Setting
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
 			<div class="sidebar-container">
 				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
	                <div id="remove-scroll">
	                    <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
	                        <li class="sidebar-toggler-wrapper hide">
	                            <div class="sidebar-toggler">
	                                <span></span>
	                            </div>
	                        </li>
	                        <li class="sidebar-user-panel">
                                <div class="user-panel">
                                <div class="profile clearfix">
                                    <div class="profile_pic">
                                        <img src="{{ asset('assets/img/user.png') }}" alt="..." class="img-circle profile_img">
                                    </div>
                                    <div class="profile_info">
                                        <span>Welcome, -- </span>
                                        <p style="color:#ccc;"> {{ Auth::user()->name }} </p>
                                    </div>
                                </div>
                                </div>
	                        </li>
	                        <li class="nav-item">
	                            <a href="/" class="nav-link nav-toggle">
	                               <i class="material-icons">dashboard</i>
	                               <span class="title">Dashboard</span>
	                            </a>
	                        </li>
                            <li class="nav-item">
                                <a  class="nav-link nav-toggle"> <i class="material-icons">event_seat</i>
                                    <span class="title">Ticket</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                @if( count($tickets) > 0 )
                                    @foreach( $tickets as $ticket )
                                    <li class="nav-item">
                                        <a href="{{ route('issued-ticket.show', $ticket->slug ) }}" class="nav-link "> <span class="title">{{ $ticket->name }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link "> <span class="title"> No Ticket </span>
                                        </a>
                                    </li>
                                @endif  
                                </ul>
                            </li>
                            @if( Auth::user()->hasPermission('print-reports') )
                            <li class="nav-item">
                                <a href="{{ route('reports.index') }}" class="nav-link nav-toggle">
                                   <i class="material-icons">insert_chart</i>
                                   <span class="title"> Reports </span>
                                </a>
                            </li>
                            @endif
	                        <li class="menu-heading m-t-20">
			                	<span> -- Advance -- </span>
			                </li>
                            @if( Auth::user()->hasPermission('ticket-setup') )
                            <li class="nav-item">
                                <a href="{{ route('ticket-setup.index') }}" class="nav-link "> 
                                    <i class="material-icons"> assistant   </i>
                                    <span class="title"> Ticket Price Setup </span>
                                </a>
                            </li>
                            @endif
                            @if( Auth::user()->hasPermission('ticket-management') )
                            <li class="nav-item">
                                <a href="{{ route('ticket.index') }}" class="nav-link "> 
                                    <i class="material-icons"> perm_data_setting  </i>
                                    <span class="title"> Ticket Management  </span>
                                </a>
                            </li>
                            @endif
                            @if( Auth::user()->hasPermission('user-management') )
	                        <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link nav-toggle">
                                   <i class="material-icons"> group </i>
                                   <span class="title"> User Management </span>
                                </a>
                            </li>
                            @endif
                            @if( Auth::user()->hasPermission('role-management') )
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}" class="nav-link nav-toggle">
                                   <i class="material-icons"> verified_user  </i>
                                   <span class="title"> Role Management </span>
                                </a>
                            </li>
                            @endif 
                            @if( Auth::user()->hasPermission('app-management') )
                            <li class="nav-item">
                                <a href="{{ route('app_setup.index') }}" class="nav-link nav-toggle">
                                   <i class="material-icons"> settings  </i>
                                   <span class="title"> App Setup </span>
                                </a>
                            </li>
                            @endif        
	                    </ul>
	                </div>
                </div>
            </div>
            <!-- end sidebar menu --> 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                   <!-- start Main Content -->
                    @yield('content')
                   <!-- end Main Content -->
                </div>
            </div>
            
        </div>
        <!-- end page container -->
        
    </div>
    <!-- start js include path -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}" ></script>
    <script src="{{ asset('assets/plugins/popper/popper.min.js') }}" ></script>
    <script src="{{ asset('assets/plugins/jquery-blockui/jquery.blockui.min.js') }}" ></script>
	<script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" ></script>
    <!-- Common js-->
	<script src="{{ asset('assets/js/app.js') }}" ></script>
    <script src="{{ asset('assets/js/layout.js') }}" ></script>
    <!-- material -->
    <script src="{{ asset('assets/plugins/material/material.min.js') }}"></script>
    <!-- animation -->
    <script src="{{ asset('assets/js/pages/ui/animations.js') }}" ></script>
    @yield('script')
  </body>
</html>