<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a>
                    @if (Auth::user()->is_admin)
                        Administrator
                    @else
                        Pegawai
                    @endif
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <!-- Optionally, you can add icons to the links -->

            @if (Auth::user()->is_admin)
                <li class="treeview">
                    <a><i class="fa fa-link"></i> <span>Administrator</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@if ($page_title == 'Atur pengajuan cuti') active @endif"><a
                                href="{{ route('breaksManagementView') }}">Atur pengajuan
                                cuti</a></li>
                        <li class="@if ($page_title == 'Atur pengguna') active @endif"><a
                                href="{{ route('usersManagementView') }}">Atur pengguna</a></li>
                    </ul>
                </li>
            @endif

            <li class="@if ($page_title == 'Dasbor') active @endif">
                <a href="{{ route('home') }}">
                    <i class="fa fa-link"></i> <span>Dasbor</span>
                </a>
            </li>

            <li class="@if ($page_title == 'Pengajuan Cuti') active @endif">
                <a href="{{ route('breakRequestView') }}">
                    <i class="fa fa-link"></i> <span>Pengajuan Cuti</span>
                </a>
            </li>

            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> <span>Keluar</span>
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <!--
            <li><a><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        -->
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
