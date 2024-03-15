<ul class="sidebar-menu">
    @if(RoleHelper::hasRole('Doctor') || RoleHelper::hasRole('Nurse') || Auth::guard('patient')->check())
        <li class="menu-header">HOME CARE</li>
        <li class="@if(URLHelper::has('dashboard')) active @endif">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
    @endif

    @if(Auth::guard('patient')->check())
        @if(!HomeCareStatusHelper::isInMonitoring())
            <li class="@if(URLHelper::has('home-care-register')) active @endif">
                <a class="nav-link" href="{{ route('home_care_register.index') }}">
                    <i class="far fa-file-alt"></i>
                    <span>Pendaftaran</span>
                </a>
            </li>
        @else
            <li class="@if(URLHelper::has('home-care')) active @endif">
                <a class="nav-link" href="{{ route('home_care.index') }}">
                    <i class="fas fa-procedures"></i>
                    <span>Home Care</span>
                </a>
            </li>
        @endif
    @endif

    @if(RoleHelper::hasRole('Doctor') || RoleHelper::hasRole('Nurse'))
        <li class="@if(URLHelper::has('home-care-patient')) active @endif">
            <a class="nav-link" href="{{ route('home_care_patient.index') }}">
                <i class="fas fa-procedures"></i>
                <span>Pasien Home Care</span>
            </a>
        </li>
        <li class="@if(URLHelper::has('report')) active @endif">
            <a class="nav-link" href="{{ route('report.index') }}">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan</span>
            </a>
        </li>
    @endif
    
    @if(RoleHelper::hasRole('Administrator'))
        <li class="menu-header">Manajemen Data</li>
        @php
            $isMasterMenuActive = false;
            foreach(['roles', 'gender', 'status'] as $menu){
                if(URLHelper::has($menu)){
                    $isMasterMenuActive = true;
                    break;
                }
            }
        @endphp
        <li class="nav-item dropdown @if($isMasterMenuActive) active @endif">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-database"></i> 
                <span>Master</span>
            </a>
            <ul class="dropdown-menu">
                <li class="@if(URLHelper::has('roles')) active @endif">
                    <a class="nav-link" href="{{ route('roles.index') }}">Role User</a>
                </li>
                <li class="@if(URLHelper::has('gender')) active @endif">
                    <a class="nav-link" href="{{ route('gender.index') }}">Jenis Kelamin</a>
                </li>
                <li class="@if(URLHelper::has('status')) active @endif">
                    <a class="nav-link" href="{{ route('status.index') }}">Status Pemantauan</a>
                </li>
            </ul>
          </li>
        <li class="{{ URLHelper::has('user') ? "active" : "" }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="fas fa-database"></i>
                <span>User</span>
            </a>
        </li>
        <li class="{{ URLHelper::has('patient') ? "active" : "" }}">
            <a class="nav-link" href="{{ route('patient.index') }}">
                <i class="fas fa-database"></i>
                <span>Pasien</span>
            </a>
        </li>
    @endif
</ul>