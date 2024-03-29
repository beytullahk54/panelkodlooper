<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="https://kodlooper.com/wp-content/uploads/2023/09/Kodlooper-yazilim-Logo-BEYAZ-800-x-300-piksel-300-x-200-piksel-500-x-200-piksel-300-x-100-piksel.png"  alt="">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span>
                        <img width="48" height="48" src="https://img.icons8.com/fluency-systems-regular/48/user--v1.png" alt="user--v1"/>

                        <!--<img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">-->
                        </span>
                    </div> 
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Hoşgeldiniz!') }}</h6>
                    </div>
                    
                    @if(Auth::User()->admin != 1)
                        <a href="{{ route('bayi.profil') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>Profilim</span>
                        </a>
                    @endif
                    <!--<a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>-->
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Çıkış Yap') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="https://kodlooper.com/wp-content/uploads/2023/09/Kodlooper-yazilim-Logo-BEYAZ-800-x-300-piksel-300-x-200-piksel-500-x-200-piksel-300-x-100-piksel.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 "></i> {{ __('Anasayfa') }}
                    </a>
                </li>

                @if(Auth::User()->admin==1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::Asset('admin/destek') }}">
                        <i class="fas fa-credit-card"></i> 
                        Destek Talepleri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.project') }}">
                        <i class="fas fa-credit-card"></i> 
                        Özel Yazılım
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::Asset('admin/hizmetler/qr-menu') }}">
                        <i class="fas fa-credit-card"></i> 
                        Qr Menü
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::Asset('admin/hizmetler/web-site') }}">
                        <i class="fas fa-credit-card"></i> 
                        Web Sitesi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::Asset('admin/hizmetler/e-ticaret') }}">
                        <i class="fas fa-credit-card"></i> 
                        E-Ticaret
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::Asset('admin/hizmetler/mobil-uygulama') }}">
                        <i class="fas fa-credit-card"></i> 
                        Mobil Uygulama
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::Asset('admin/hizmetler/web-view') }}">
                        <i class="fas fa-credit-card"></i> 
                        Web View
                        </a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.ayarlar') }}">
                            <i class="fas fa-cogs"></i> Ayarlar
                        </a>
                    </li>-->

                @endif
            </ul>
        </div>
    </div>
</nav>
