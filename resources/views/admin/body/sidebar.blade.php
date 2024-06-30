<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>School</b> Management</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            @php
                $route = Route::currentRouteName();
                $prefix = '/admin/setups/';
            @endphp

            <li class="{{ $route == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @if (auth()->user()->role == 'admin')
                <li class="treeview">
                    <a href="#">
                        <i data-feather="message-circle"></i>
                        <span>Manage User</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'user.view' ? 'active' : '' }}"><a href="{{ route('user.view') }}"><i class="ti-more"></i>View User</a></li>
                        <li class="{{ $route == 'user.add' ? 'active' : '' }}"><a href="{{ route('user.add') }}"><i class="ti-more"></i>Add User</a></li>
                    </ul>
                </li>
            @endif

            <li class="treeview">
                <a href="#">
                    <i data-feather="mail"></i> <span>Manage Profile</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'profile.view' ? 'active' : '' }}"><a href="{{ route('profile.view') }}"><i class="ti-more"></i>Your Profile</a></li>
                    <li class="{{ $route == 'change.password' ? 'active' : '' }}"><a href="{{ route('change.password') }}"><i class="ti-more"></i>Change Password</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="mail"></i> <span>Setup Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'student.class.view' ? 'active' : '' }}">
                        <a href="{{ route('student.class.view') }}"><i class="ti-more"></i>
                            Student Class
                        </a>
                    </li>
                    <li class="{{ $route == 'student.year.view' ? 'active' : '' }}">
                        <a href="{{ route('student.year.view') }}"><i class="ti-more"></i>
                            Student Year
                        </a>
                    </li>
                    <li class="{{ $route == 'student.group.view' ? 'active' : '' }}">
                        <a href="{{ route('student.group.view') }}"><i class="ti-more"></i>
                            Student Group
                        </a>
                    </li>
                    <li class="{{ $route == 'student.shift.view' ? 'active' : '' }}">
                        <a href="{{ route('student.shift.view') }}"><i class="ti-more"></i>
                            Student Shift
                        </a>
                    </li>
                    <li class="{{ $route == 'student.fee.view' ? 'active' : '' }}">
                        <a href="{{ route('student.fee.view') }}"><i class="ti-more"></i>
                            Fee Category
                        </a>
                    </li>
                    <li class="{{ $route == 'fee.amount.view' ? 'active' : '' }}">
                        <a href="{{ route('fee.amount.view') }}"><i class="ti-more"></i>
                            Fee Category Amount
                        </a>
                    </li>
                    <li class="{{ $route == 'student.exam.view' ? 'active' : '' }}">
                        <a href="{{ route('student.exam.view') }}"><i class="ti-more"></i>
                            Student Exam
                        </a>
                    </li>
                    <li class="{{ $route == 'student.subject.view' ? 'active' : '' }}">
                        <a href="{{ route('student.subject.view') }}"><i class="ti-more"></i>
                            School Subject
                        </a>
                    </li>
                    <li class="{{ $route == 'assign.subject.view' ? 'active' : '' }}">
                        <a href="{{ route('assign.subject.view') }}"><i class="ti-more"></i>
                            Assign Subject
                        </a>
                    </li>
                    <li class="{{ $route == 'designation.view' ? 'active' : '' }}">
                        <a href="{{ route('designation.view') }}"><i class="ti-more"></i>
                            Designation
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Student Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'student.registration.view' ? 'active' : '' }}">
                        <a href="{{ route('student.registration.view') }}"><i class="ti-more"></i>Student Registration</a>
                    </li>
                    <li class="{{ $route == 'role.generate.view' ? 'active' : '' }}">
                        <a href="{{ route('role.generate.view') }}"><i class="ti-more"></i>Role Generate</a>
                    </li>
                    <li class="{{ $route == 'registration.fee.view' ? 'active' : '' }}">
                        <a href="{{ route('registration.fee.view') }}"><i class="ti-more"></i>Registration Fee</a>
                    </li>
                    <li class="{{ $route == 'month.fee.view' ? 'active' : '' }}">
                        <a href="{{ route('month.fee.view') }}"><i class="ti-more"></i>Monthly Fee</a>
                    </li>
                    <li class="{{ $route == 'exam.fee.view' ? 'active' : '' }}">
                        <a href="{{ route('exam.fee.view') }}"><i class="ti-more"></i>Exam Fee</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Employee Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'employee.registration.view' ? 'active' : '' }}">
                        <a href="{{ route('employee.registration.view') }}"><i class="ti-more"></i>Employee Registration</a>
                    </li>
                </ul>
            </li>

            <li class="header nav-small-cap">User Interface</li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>Components</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
                </ul>
            </li>

        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
