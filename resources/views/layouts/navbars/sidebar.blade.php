@yield('sidebar')
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="#" alt="..." class="navbar-brand-img">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="navbar-examples">
                            <i class="ni ni-books" style="color: #f4645f;"></i>
                            <span class="nav-link-text" style="color: #f4645f;">{{ __('Data Master') }}</span>
                        </a>

                        <div class="collapse show" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pasien.index') }}">
                                        {{ __('List Pasien') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('kategori.index') }}">
                                        {{ __('Kategori Penyakit') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ route('tipe_asuransi.index') }}">
                                      {{ __('Asuransi') }}
                                  </a>
                              </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('kategori.index') }}">
                          <i class="ni ni-ambulance text-red"></i> {{ __('Klaim Asuransi') }}
                      </a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('kategori.index') }}">
                          <i class="ni ni-paper-diploma text-orange"></i> {{ __('Reimburse') }}
                      </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>