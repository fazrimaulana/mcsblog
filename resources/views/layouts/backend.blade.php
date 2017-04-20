@php
    
    use Modules\Settings\Models\Setting;

    $title_dashboard = Setting::where('setting_name', 'site_title')->first(); 

@endphp


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Route::currentRouteName() }}-{{ $title_dashboard->setting_value }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('/backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ url('/backend/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/backend/css/font-awesome.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>

<body>

    <!-- .HEADER-->
    <div class="header">
        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="header-left col-md-3 col-sm-5 col-xs-12">
                    <div class="navbar-header text-center">
                        <div class="menu-toggle pull-left">
                            <a href="#menu-toggle" id="menu-toggle">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="brand">
                            <a class="navbar-brand" href="#"><p>MCS Admin</p></a>
                        </div>
                        
                    </div><!--END OF .NAVBAR-HEADER-->
                </div><!--END OF .HEADER-LEFT-->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="header-right col-md-9 col-sm-7 col-xs-12">
                    <div class="menu-right" style="float: right;">
                        <!--.NAVBAR-RIGHT-->
                        <ul class="nav navbar-nav nav-pills navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                                    <span class="badge message">42</span>
                                </a>
                                <ul class="dropdown-menu dropdown-notification">
                                    <div class="header-notification text-center">
                                        <li><p>You have 42 Message</p></li>
                                    </div>
                                    <div class="list-notification">
                                        <li>
                                            <a href="#">
                                                <div class="gambar col-md-1 col-sm-1 col-xs-1">
                                                    <img src="{{ url('/backend/images/icon-user.jpeg') }}">
                                                </div>
                                                <div class="font col-md-10 col-sm-10 col-xs-10">
                                                    <p><strong>Nama_User</strong> sent you an image.</p>
                                                    <i>1 minute ago</i>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="footer-notification text-center">
                                        <li><a href="#">Inbox</a></li>
                                    </div>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell fa-lg" aria-hidden="true"></i>
                                    <span class="badge notification">42</span>
                                </a>
                                <ul class="dropdown-menu dropdown-notification">
                                    <div class="header-notification text-center">
                                        <li><p>You have 42 Notification</p></li>
                                    </div>
                                    <div class="list-notification">
                                        <li>
                                            <a href="#">
                                                <div class="gambar col-md-1 col-sm-1 col-xs-1">
                                                    <img src="{{ url('/backend/images/icon-user.jpeg') }}">
                                                </div>
                                                <div class="font col-md-10 col-sm-10 col-xs-10">
                                                    <p><strong>Nama_User</strong> sent you an image.</p>
                                                    <i>1 minute ago</i>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="footer-notification text-center">
                                        <li><a href="#">View all</a></li>
                                    </div>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ url('/backend/images/icon-user.jpeg') }}">
                                    <strong>{{ Auth::user()->usermeta->display_name }}</strong>
                                </a>
                                <ul class="dropdown-menu dropdown-user" id="user">
                                    <div class="header-dropdown-user text-center">
                                        <li><strong>{{ Auth::user()->usermeta->display_name }}</strong></li>
                                    </div>
                                    <div class="menu-user">
                                        <li>
                                            <a href="{{ url('/dashboard/users/'.Auth::user()->id.'/profile') }}">
                                                <p><i class="fa fa-user" aria-hidden="true"></i> User Profile</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/logoutUser') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <p><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</p>
                                            </a>

                                            <form id="logout-form" action="{{ url('/logoutUser') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul><!--END OF .NAVBAR-RIGH -->
                    </div><!--END OF .MENU-RIGHT-->
                </div><!--END OF .HEADER-RIGH -->
            </div><!-- /.container-fluid -->
        </nav>
    </div><!--END OF .HEADER-->

        <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="user-media col-md-12 col-sm-12 col-xs-12">
                <div class="user">
                    <a href="#">
                        <div class="images col-md-4 col-sm-4 col-xs-4">
                            <img src="{{ url('/backend/images/admin.jpeg') }}">
                        </div>
                        <div class="font col-md-8 col-sm-8 col-xs-8">
                            <p>Welcome</p>
                            <p>{{ Auth::user()->usermeta->display_name }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div><!--END OF .USER-->
            </div><!--END OF .USER-MEDIA-->
            <ul class="sidebar-nav">
                <?php

                    $str = url(Modules\Settings\Models\Setting::getData('home_url'));
                    $url = url('/');
                    $home = str_replace($url,"",$str);

                ?>
                <li>
                    <a href="{{ url($home) }}" class=" {{ strpos(Route::currentRouteName(), 'home.dashboard') === 0 ? 'active' : '' }} ">
                        <i class="fa fa-home fa-lg" aria-hidden="true"> <span>Dashboard</span></i>
                    </a>
                </li>

                @php
                    use Modules\Module\Models\Menu;
                    use Modules\Module\Models\Module;
                    $menus = Menu::where('parent_id', '')->orderBy('sequence', 'ASC')->get();
                @endphp
                @foreach($menus as $menu)

                    @php
                        $moduleActive = Module::where('module', $menu->module)->where('status', 'active')->first();
                        $childMenu = Menu::where('parent_id', $menu->menu_id)->get();
                    @endphp

                    @if(Auth::user()->hasRole('root') || Auth::user()->can($menu->permission) )

                        @if($moduleActive)

                            <li>
                                <a  class="{{ strpos(Route::currentRouteName(), $menu->menu_id) === 0 ? 'active' : '' }}" 
                                    @if(count($childMenu)!=0)
                                        href="javascript:;"
                                        data-toggle="collapse"
                                        data-target=".{{ $menu->id }}"
                                    @else
                                        href="{{ url($menu->href) }}"
                                    @endif
                                >
                                    <i class="{{ $menu->icon }}" aria-hidden="true"> <span>{{ $menu->name }}</span></i>
                                </a>    

                                @if(count($childMenu)!=0)
                                    <ul class="collapse {{ $menu->id }}" id="menu-post">
                                        @foreach($childMenu as $child)
                                            <li><a href="{{ url($child->href) }}"> {{ $child->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>

                        @endif

                    @endif

                @endforeach

            </ul><!--END OF SIDEBAR-NAV-->
        </div>
        <!-- /#sidebar-wrapper -->

        @yield('content')

    </div>
    <!-- /#wrapper -->

    <!--  jQuery -->
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->

    <script src="{{ url('/backend/js/jquery.js') }}" type="text/javascript"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('/backend/js/bootstrap.min.js') }}"></script>

    <!-- Nice Scroll -->
    <script src="{{ url('/backend/js/jquery.nicescroll.min.js') }}"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

    
    <script type="text/javascript">
        $(document).ready(function() {  
            'use strict';

            $(".list-notification").niceScroll({
                cursorcolor: "#eaeaea",
                cursorwidth: "8px",
                cursorborder: "none",
            });
        });
    </script>

    @yield('javascript')

</body>
</html>
