<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">based</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            {{-- MENU PENGGUNA --}}
            {{-- SEMUA PENGGUNA / USER MEMPUNYAI MENU INI --}}
            <li class="menu-header">Pengguna</li>
            <li class="" id="liDashboard"><a class="nav-link" href="{{ URL::to('/dashboard') }}"><i
                        class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li class="" id="liProfile"><a class="nav-link" href="{{ URL::to('/profile') }}"><i
                        class="fas fa-user"></i>
                    <span>Profile</span></a></li>
            <li class="" id="liBantuan"><a class="nav-link" href="{{ URL::to('/bantuan') }}"><i
                        class="fas fa-question-circle"></i> <span>Bantuan</span></a></li>



            @if (auth()->user()->role == 'Administrator')
                {{-- MENU ADMIN --}}
                <li class="menu-header">Admin</li>
                <li class="nav-item dropdown " id="liPengguna">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                        <span>Pengguna</span></a>
                    <ul class="dropdown-menu">
                        <li id="liManajemenPengguna"><a class="nav-link" href="/admin/pengguna">Manajemen Pengguna</a>
                        </li>
                    </ul>
                </li>

                <li class="" id="liJabatan"><a class="nav-link" href="{{ URL::to('/admin/jabatan') }}"><i
                            class="fas fa-user-tie"></i> <span>Jabatan</span></a></li>
                <li class="" id="liTugas"><a class="nav-link" href="{{ URL::to('/admin/tugas') }}"><i
                            class="fas fa-list"></i> <span>Tugas</span></a></li>
                {{-- END OF MENU ADMIN --}}
            @endif

            @if (auth()->user()->role == 'pegawai')
                {{-- MENU pegawai --}}
                <li class="menu-header">Pegawai</li>
                <li class="" id="liUploadBerkas"><a class="nav-link"
                        href="{{ URL::to('/pegawai/upload_berkas') }}"><i class="fas fa-file"></i> <span>Upload
                            Berkas</span></a></li>
                {{-- <li class="" id="liTugas"><a class="nav-link" href="{{ URL::to('/pegawai/tugas') }}"><i
                            class="fas fa-list"></i> <span>Tugas</span></a></li> --}}
                {{-- END OF MENU pegawai --}}
            @endif

            @if (auth()->user()->role == 'sekretaris')
                {{-- MENU pegawai --}}
                <li class="menu-header">Sekretaris</li>
                <li class="" id="liVerifikasiBerkas"><a class="nav-link"
                        href="{{ URL::to('/sekretaris/verifikasi_berkas') }}"><i class="fas fa-file"></i>
                        <span>Verifikasi
                            Berkas</span></a></li>

                {{-- END OF MENU pegawai --}}
            @endif

            @if (auth()->user()->role == 'pejabat')
                {{-- MENU pegawai --}}
                <li class="menu-header">Pejabat</li>
                <li class="" id="liTimeline"><a class="nav-link" href="{{ URL::to('/pejabat/timeline') }}"><i
                            class="fas fa-chart-bar"></i>
                        <span>Timeline</span></a></li>

                {{-- END OF MENU pegawai --}}
            @endif







        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ URL::to('/logout') }}" class="btn btn-dark btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>
