<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="@if (Request::segment(1)=='dashboard' ) active @endif"><a class="nav-link"
                    href="{{ route('dashboard') }}"><i class="fas fa-fire"></i>
                    <span>dashboard</span></a></li>

            <li class="menu-header">Menu</li>
            @foreach (SiteHelpers::main_menu() as $mm)
            <li class="nav-item dropdown @if (Request::segment(1) == $mm->url  ) active @endif">
                <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>{{ $mm->nama_menu}}</span></a>
                
                    <ul class="dropdown-menu">

                    @foreach (SiteHelpers::sub_menu() as $sm)

                    @if ($sm->master_menu == $mm->id)
                    <li @if (Request::segment(1).'/'. Request::segment(2) == $sm->url) 
                        class="active"
                    @endif><a class="nav-link  " href="{{ url($sm->url) }}">{{$sm->nama_menu }}</a></li>
                    @endif

                    @endforeach



                </ul>
            </li>
            @endforeach
            {{-- <li class="nav-item dropdown @if (Request::segment(1)=='konfigurasi' and
                Request::segment(2)=='setup' ) active @endif">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Konfigurasi</span></a>
                <ul class="dropdown-menu">
                    <li class="@if (Request::segment(1)=='konfigurasi'  ) active @endif"><a class="nav-link  " href="
                            {{ route('setup.index') }}">Setup Aplikasi</a></li>
        </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown @if (Request::segment(1)=='master-data'  ) active @endif"
                data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Master Data</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('masterdata.setup') }}">Setup Aplikasi</a></li>
                @can('akses')
                <li class="@if (Request::segment(1)=='master-data' and Request::segment(2)=='divisi' ) active @endif">
                    <a class="nav-link  " href="{{ route('divisi.index') }}">Divisi</a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="@if (Request::segment(1)=='crud' ) active @endif">
            <a class="nav-link" href="{{ route('crud') }}"><i class="far fa-square"></i>
                <span>CRUD</span></a></li> --}}


        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
