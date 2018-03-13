@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            @can('instructor')
                <li class="{{ $request->segment(1) == 'instructor' ? 'active' : '' }}">
                    <a href="{{ url('/admin/instructor/dashboard') }}">
                        <i class="fa fa-wrench"></i>
                        <span class="title">@lang('global.app_dashboard')</span>
                    </a>
                </li>
                <li class="{{ $request->segment(2) == 'report' ? 'active' : '' }}">
                    <a href="{{ url('/admin/instructor/report') }}">
                        <i class="fa fa-bar-chart"></i>
                        <span class="title">Report</span>
                    </a>
                </li>
                <li class="{{ $request->segment(2) == 'report' ? 'active' : '' }}">
                    <a href="{{ route('admin.insHelpDash') }}">
                        <i class="fa fa-question"></i>
                        <span class="title">Help Desk</span>
                    </a>
                </li>

            @elsecan('director')
                <li class="{{ $request->segment(2) == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('/admin/director/dashboard') }}">
                        <i class="fa fa-wrench"></i>
                        <span class="title">@lang('global.app_dashboard')</span>
                    </a>
                </li>
                <li class="{{ $request->segment(2) == 'report' ? 'active' : '' }}">
                    <a href="{{ url('/admin/director/report') }}">
                        <i class="fa fa-bar-chart"></i>
                        <span class="title">Report</span>
                    </a>
                </li>
            @elsecan('course_builder')
                <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                    <a href="{{ url('/admin/course_builder/dashboard') }}">
                        <i class="fa fa-wrench"></i>
                        <span class="title">@lang('global.app_dashboard')</span>
                    </a>
                </li>
                <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                    <a href="{{ url('/admin/course_builder/report') }}">
                        <i class="fa fa-bar-chart"></i>
                        <span class="title">Report</span>
                    </a>
                </li>
            @endcan


            
            @can('users_manage')
                    <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                        <a href="{{ url('/') }}">
                            <i class="fa fa-wrench"></i>
                            <span class="title">@lang('global.app_dashboard')</span>
                        </a>
                    </li>
                <li class="{{ $request->segment(1) == 'admin_report' ? 'active' : '' }}">
                    <a href="{{ url('/admin/admin_report') }}">
                        <i class="fa fa-bar-chart"></i>
                        <span class="title">Generate Report</span>
                    </a>
                </li>
                <li class="{{ $request->segment(2) == 'helpdesk' ? 'active' : '' }}">
                    <a href="{{ route('admin.adminHelpDesk') }}">
                        <i class="fa fa-question-circle"></i>
                        <span class="title">Help questions</span>
                    </a>
                </li>

                    <li class="{{ $request->segment(3) == 'years' ? 'active' : '' }}">
                        <a href="{{ route('admin.courseYear')}}">
                            <i class="fa fa-calendar"></i>
                            <span class="title">Years / Semesters</span>
                        </a>
                    </li>


                <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.permissions.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>


                {{--admin dshboard item collage--}}

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-university"></i>
                        <span class="title">@lang('global.collage-management.title')</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">

                        <li class="{{ $request->segment(2) == 'collages' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.AllCollages') }}">
                                <i class="fa fa-university"></i>
                                <span class="title">
                                @lang('global.collage-management.title')
                            </span>
                            </a>
                        </li>
                        <li class="{{ $request->segment(2).$request->segment(3) == 'collagescreate' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.createCollageRoute') }}">
                                <i class="fa fa-plus"></i>
                                <span class="title">
                                @lang('global.collage-management-create.title')
                            </span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--end admin dshboard item collage--}}

                {{--admin dshboard item department--}}

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-building-o"></i>
                        <span class="title">@lang('global.department-management.title')</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">

                        <li class="{{ $request->segment(2) == 'departments' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.AllDepartment') }}">
                                <i class="fa fa-building-o"></i>
                                <span class="title">
                                @lang('global.department-management.title')
                            </span>
                            </a>
                        </li>
                        <li class="{{ $request->segment(2).$request->segment(3) == 'departmentscreate' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.createDepartmentRoute') }}">
                                <i class="fa fa-plus"></i>
                                <span class="title">
                                @lang('global.department-management-create.title')
                            </span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--end admin dshboard item department--}}
                {{--admin dshboard item department--}}

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-graduation-cap"></i>
                        <span class="title">@lang('global.course-management.title')</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">

                        <li class="{{ $request->segment(2) == 'courses' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.AllCourses') }}">
                                <i class="fa fa-graduation-cap"></i>
                                <span class="title">
                                @lang('global.course-management.title')
                            </span>
                            </a>
                        </li>
                        <li class="{{ $request->segment(2).$request->segment(3) == 'coursescreate' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.createCourseRoute') }}">
                                <i class="fa fa-plus"></i>
                                <span class="title">
                                @lang('global.course-management-create.title')
                            </span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--end admin dshboard item department--}}
                {{--admin dshboard item workshop--}}

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-code-fork"></i>
                        <span class="title">@lang('global.workshop-management.title')</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">

                        <li class="{{ $request->segment(2) == 'workshops' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.AllWorkshops') }}">
                                <i class="fa fa-code-fork"></i>
                                <span class="title">
                                @lang('global.workshop-management.title')
                            </span>
                            </a>
                        </li>
                        <li class="{{ $request->segment(2).$request->segment(3) == 'workshopscreate' ? 'active active-sub' : '' }}">
                            <a href="{{ route('admin.createWorkshopRoute') }}">
                                <i class="fa fa-plus"></i>
                                <span class="title">
                                @lang('global.workshop-management-create.title')
                            </span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--end admin dshboard item workshop--}}
            @endcan

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>

                <li>
                    <a href="{{url('/admin/profile')}}">
                        <i class="fa fa-user"></i>
                        <span class="title">View Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#logout" onclick="$('#logout').submit();">
                        <i class="fa fa-arrow-left"></i>
                        <span class="title">@lang('global.app_logout')</span>
                    </a>
                </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}
