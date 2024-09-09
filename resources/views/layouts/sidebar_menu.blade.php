<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION {{ Auth::user()->user_type }}</li>

    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>

    @if (Auth::user()->user_type == 'SUADMIN' || Auth::user()->user_type == 'ADMIN')
        <li class="treeview">
            <a style="cursor: pointer;">
                <i class="fa fa-building text-green"></i>
                <span>Wearhous</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('/wearhouse') }}"><i class="fa fa-circle-o"></i> <span>Add new</span></a></li>



            </ul>
        </li>
    @endif

    <li class="treeview">
        <a style="cursor: pointer;">
            <i class="fa fa-pie-chart text-yellow"></i>
            <span>Center</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('/center') }}"><i class="fa fa-circle-o"></i> <span>Add new</span></a></li>
        </ul>
    </li>


    <li class="treeview">
        <a style="cursor: pointer;">
            <i class="fa fa-pie-chart text-yellow"></i>
            <span>Category</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('/baseline_survey') }}"><i class="fa fa-circle-o"></i> <span>Add new</span></a>
            </li>
        </ul>
    </li>

    <li class="treeview">
        <a style="cursor: pointer;">
            <i class="fa fa-pie-chart text-yellow"></i>
            <span>Item</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('/item') }}"><i class="fa fa-circle-o"></i> <span>Add new</span></a>
            </li>
        </ul>
    </li>

    <li class="treeview">
        <a style="cursor: pointer;">
            <i class="fa fa-pie-chart text-yellow"></i>
            <span>Stock</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('/stock') }}"><i class="fa fa-circle-o"></i> <span>Add new</span></a>
            </li>

            <li><a href="{{ url('/movein') }}?action=1"><i class="fa fa-circle-o"></i> <span>Move In Item to DC
                        office</span></a>
            </li>
        </ul>
    </li>






</ul>
