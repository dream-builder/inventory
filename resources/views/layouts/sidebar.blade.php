<aside class="main-sidebar" style="position: fixed">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("public/image/admin.jpg")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!--
            <li class="header">Menu</li>
            @if(Auth::user()->user_type == 'SUADMIN')
                <li class="treeview active">
                    <a>
                        <i class="fa fa-users"></i>
                        <span>User Registration</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu menu-open" style="display: block;">
                        <li>
                            <a href="{{ route('register')}}">
                                <i class="fa fa-user-plus"></i>
                                <span>User Add</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register/list')}}">
                                <i class="fa fa-list"></i>
                                <span>User List</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="treeview ">
                <a >
                    <i class="fa fa-question-circle-o"></i>
                    <span>Questionnaire</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open" style="display: block;">
                    @if(Auth::user()->user_type == 'SUADMIN' || Auth::user()->user_type == 'ADMIN')
                    <li>
                        <a href="{{ url('section/create')}}">
                            <i class="fa fa-plus"></i>
                            <span>Add Section</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('section')}}">
                            <i class="fa fa-list"></i>
                            <span>Section List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('question/create')}}">
                            <i class="fa fa-plus"></i>
                            <span>Add/Edit Question</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ url('survey')}}">
                            <i class="fa fa-list-alt"></i>
                            <span>Survey</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a >
                    <i class="fa fa-registered"></i>
                    <span>Reports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open" style="display: block;">
                    @if(Auth::user()->user_type == 'SUADMIN' || Auth::user()->user_type == 'ADMIN'|| Auth::user()->user_type == 'REPORT-VIEW')
                        <li>
                            <a href="{{ url('reports/category_details')}}">
                                <i class="fa fa-line-chart"></i>
                                <span>Category Details</span>
                            </a>
                        </li>

                    @endif
                </ul>
            </li>
			-->
			<!-- Comment menu -->
			<li class="treeview">
                <a >
                    <i class="fa fa-tasks"></i>
                    <span>Tasks</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: block;">
						<li>
                            <a href="{{ url('/dashboard')}}">
                                <i class="fa fa-line-chat"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
						
						<!--<li>
                            <a href="{{ url('/issue')}}">
                                <i class="fa fa-line-chat"></i>
                                <span>Issue</span>
                            </a>
                        </li> !-->
                   
                        <li>
                            <a href="{{ url('/comments')}}">
                                <i class="fa fa-line-chat"></i>
                                <span>Issue/Comments</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/facility/register')}}">
                                <i class="fa fa-line-chat"></i>
                                <span>Add New Facility</span>
                            </a>
                        </li>

                  
                </ul>
            </li>
			<!-- comment menu -->
			
			
			
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside> 