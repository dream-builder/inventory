<!-- Main Header -->
<header class="main-header" style="position:fixed;width: 100%">

    <!-- Logo -->
    <a class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"></span>
    </a>

    <!-- Header Navbar -->
    @if (Auth::user()->user_type != 'FWV-SACMO')
        <nav class="navbar navbar-static-top 1" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    {{-- {!! Admin::getNavbar()->render() !!} --}}


                    <!-- {{ \App\Http\Controllers\Notification::my_pending_task(Auth::user()->user_id) }} -->

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ asset('public/image/admin.jpg') }}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ asset('public/image/admin.jpg') }}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->name }}
                                    <small><?php echo $mytime = Carbon\Carbon::now()->toDateTimeString(); ?></small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="account/password_change" class="btn btn-default btn-flat">Setting</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="btn btn-default btn-flat">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <span class="fa fa-flag"></span>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    {{-- <li> --}}
                    {{-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> --}}
                    {{-- </li> --}}
                </ul>
            </div>
        </nav>
    @endif
</header>
