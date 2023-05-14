<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
			<li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="nav-item {{ set_active('dashboard.index') }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Beranda</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item {{ set_active(['level.index','question.index','category.index','uom-val.index','pay-method.index','pay-term.index','facilitator.index']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Konfigurasi Umum</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['question.index']) }}">
                        <a href="{{ route('question.index') }}" class="nav-link">
                            <span class="title">Data Kuesioner</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['category.index']) }}">
                        <a href="{{ route('category.index') }}" class="nav-link">
                            <span class="title">Kategori Training</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['level.index']) }}">
                        <a href="{{ route('level.index') }}" class="nav-link">
                            <span class="title">Level Training</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['facilitator.index']) }}">
                        <a href="{{ route('facilitator.index') }}" class="nav-link">
                            <span class="title">Data Trainer</span>
                        </a>
                    </li>                                   
                </ul>
            </li>
            @can('Can Access Users')
            <li class="nav-item {{ set_active(['user.index','user.profile','role.index','uker.index','user.log','role.create','role.edit','depart.index']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Manajemen User</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['user.index','user.profile']) }}">
                        <a href="{{ route('user.index') }}" class="nav-link ">
                            <span class="title">Daftar User</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['role.index','role.create','role.edit']) }}">
                        <a href="{{ route('role.index') }}" class="nav-link ">
                            <span class="title">Hak Akses</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['uker.index']) }}">
                        <a href="{{ route('uker.index') }}" class="nav-link ">
                            <span class="title">Divisi</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['depart.index']) }}">
                        <a href="{{ route('depart.index') }}" class="nav-link ">
                            <span class="title">Departemen</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['user.log']) }}">
                        <a href="{{ route('user.log') }}" class="nav-link ">
                            <span class="title">Log Aktivitas</span>
                        </a>
                    </li>                                    
                </ul>
            </li>
            @endcan
            <li class="nav-item {{ set_active(['hour.index','people.create','training.index','trainingPeople.show']) }}">
            	<a href="javascript:;" class="nav-link nav-toggle">
            		<i class="icon-social-dropbox"></i>
            		<span class="title">Training Records</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['training.index','trainingPeople.show']) }}">
                        <a href="{{ route('training.index') }}" class="nav-link">
                            <span class="title">Data Pelatihan</span>
                        </a>
                    </li> 
                </ul>
            </li>
            @can('Can Access Reports')
            <li class="nav-item {{ set_active(['reportTraining.index']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Laporan</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['reportTraining.index']) }}">
                        <a href="{{ route('reportTraining.index') }}" class="nav-link ">
                            <span class="title">Training</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="" class="nav-link ">
                            <span class="title">Peserta</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="" class="nav-link ">
                            <span class="title">Trainer</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>
    </div>
</div>