@yield('sidebar')
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                {{-- <img src="#" alt="..." class="navbar-brand-img"> --}}
                <span>Klinik XYZ</span>
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('pasien') || request()->is('kategori') || request()->is('tipe_asuransi')) ? 'active' : '' }}" href="#navbar-examples" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="navbar-examples">
                            <i class="ni ni-books" style="color: #f4645f;"></i>
                            <span class="nav-link-text" style="color: #f4645f;">{{ __('Data Master') }}</span>
                        </a>

                        <div class="collapse show" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                @if(Auth::user()->roles[0]['name'] == 'Staff' || Auth::user()->roles[0]['name'] == 'Admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('pasien') ? 'active' : '' }}" href="{{ route('pasien.index') }}">
                                        {{ __('List Pasien') }}
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->roles[0]['name'] == 'Admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('kategori') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                                        {{ __('Kategori Penyakit') }}
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->roles[0]['name'] == 'Admin')
                                <li class="nav-item">
                                  <a class="nav-link {{ request()->is('tipe_asuransi') ? 'active' : '' }}" href="{{ route('tipe_asuransi.index') }}">
                                      {{ __('Asuransi') }}
                                  </a>
                              </li>
                              @endif

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('pasien') || request()->is('kategori') || request()->is('tipe_asuransi')) ? 'active' : '' }}" href="#navbar-examples-klaim" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="navbar-examples-klaim">
                            <i class="ni ni-ambulance text-red" style="color: #f4645f;"></i>
                            <span class="nav-link-text">{{ __('Asuransi') }}</span>
                        </a>

                        <div class="collapse show" id="navbar-examples-klaim">
                            <ul class="nav nav-sm flex-column">
                                @if(Auth::user()->roles[0]['name'] == 'Staff' || Auth::user()->roles[0]['name'] == 'Admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('klaimasuransi/list') ? 'active' : '' }}" href="{{ route('klaimasuransi.index') }}">
                                        {{ __('Klaim Asuransi') }}
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->roles[0]['name'] == 'Admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('klaimasuransi/report') ? 'active' : '' }}" href="{{ route('klaimasuransi.report') }}">
                                        {{ __('Report Klaim') }}
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('pasien') || request()->is('kategori') || request()->is('tipe_asuransi')) ? 'active' : '' }}" href="#navbar-examples-reimburse" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="navbar-examples-reimburse">
                            <i class="ni ni-ambulance text-green"></i>
                            <span class="nav-link-text">{{ __('Reimburse') }}</span>
                        </a>

                        <div class="collapse show" id="navbar-examples-reimburse">
                            <ul class="nav nav-sm flex-column">
                                @if(Auth::user()->roles[0]['name'] == 'Staff' || Auth::user()->roles[0]['name'] == 'Admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('reimburse') ? 'active' : '' }}" href="{{ route('reimburse.index') }}">
                                        {{ __('Reimburse Pasien') }}
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->roles[0]['name'] == 'Admin')
                                <li class="nav-item">
                                  <a class="nav-link {{ request()->is('reimburse/report') ? 'active' : '' }}" href="{{ route('reimburse.report') }}">
                                      {{ __('Report Reimburse') }}
                                  </a>
                              </li>
                              @endif

                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>