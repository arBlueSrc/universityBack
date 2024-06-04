<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="">
    <!-- Brand Logo -->
    <a href="{{ url('admin') }}" class="brand-link" style="text-align: center">

        <span class="brand-text font-weight-light">سامانه جمع آوری اطلاعات Q</span>


    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar Menu -->
            <nav class="user-panel mt-2">

                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('userAnswer.index') }}" class="nav-link {{ isActive('userAnswer.index') }}">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>لیست اطلاعات ثبت شده</p>
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- /.sidebar-menu -->




        </div>
    </div>
    <!-- /.sidebar -->
</aside>
