@extends('layouts.app', ['title' => __('Detail Pasien')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Detail Pasien'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        {{-- <div class="row align-items-center"> --}}
                            <h3 class="mb-2">{{ __('Detail Pasien') }}</h3>
                        {{-- </div> --}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="#" autocomplete="off">
                            @csrf
                            @method('post')
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="pl-lg-4">
                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('nama_lengkap') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-gol-darah">{{ __('Nama') }}</label>
                                        <input type="text" name="nama_lengkap" value="{{$pasien->nama_lengkap}}" id="input-gol-darah" class="form-control form-control-alternative{{ $errors->has('nama_lengkap') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama') }}" required disabled>
    
                                        @if ($errors->has('nama_lengkap'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama_lengkap') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('nik') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-nik">{{ __('NIK') }}</label>
                                        <input type="nik" name="nik" value="{{$pasien->nik}}" id="input-nik" class="form-control form-control-alternative{{ $errors->has('nik') ? ' is-invalid' : '' }}" placeholder="{{ __('NIK') }}" required disabled>
    
                                        @if ($errors->has('nik'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nik') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('tempat_lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-tempat-lahir">{{ __('Tempat Lahir') }}</label>
                                        <input type="text" name="tempat_lahir" value="{{$pasien->tempat_lahir}}" id="input-tempat-lahir" class="form-control form-control-alternative{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempat lahir') }}" disabled>
    
                                        @if ($errors->has('tempat_lahir'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('tanggal_lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-tanggal-lahir">{{ __('Tanggal Lahir') }}</label>
                                        <input type="date" name="tanggal_lahir" value="{{$pasien->tanggal_lahir}}" id="input-tanggal-lahir" class="form-control form-control-alternative{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tanggal lahir') }}" disabled>
    
                                        @if ($errors->has('tanggal_lahir'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-12{{ $errors->has('jenis_kelamin') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-jenis-kelamin">{{ __('Jenis Kelamin') }}</label>
                                        <select class="form-control form-control-alternative" name="jenis_kelamin" id="input-jenis-kelamin" disabled>
                                            <option value="Laki-laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>

                                        @if ($errors->has('jenis_kelamin'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-gol-darah">{{ __('Gol. Darah') }}</label>
                                        <input type="text" name="golongan_darah" value="{{$pasien->golongan_darah}}" id="input-gol-darah" class="form-control form-control-alternative{{ $errors->has('golongan-darah') ? ' is-invalid' : '' }}" placeholder="{{ __('Golongan Darah') }}" required disabled>
    
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                                        <input type="text" name="alamat" value="{{$pasien->alamat}}" id="input-alamat" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" required disabled>
    
                                        @if ($errors->has('alamat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('usia') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-usia">{{ __('Usia') }}</label>
                                        <input type="number" name="usia" value="{{$pasien->usia}}" id="input-usia" class="form-control form-control-alternative{{ $errors->has('usia') ? ' is-invalid' : '' }}" placeholder="{{ __('Usia') }}" required disabled>
    
                                        @if ($errors->has('usia'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('usia') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <hr class="my-4" />

                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('harga-obat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-harga-obat">{{ __('Harga Obat') }}</label>
                                        <input type="text" name="harga_obat" value="{{$pasien->harga_obat}}" id="input-harga-obat" class="form-control form-control-alternative{{ $errors->has('harga-obat') ? ' is-invalid' : '' }}" placeholder="{{ __('Rp. 00') }}"  disabled>
    
                                        @if ($errors->has('harga-obat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('harga-obat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('tanggal-lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-harga-tindakan">{{ __('Harga Tindakan') }}</label>
                                        <input type="text" name="harga_tindakan" value="{{$pasien->harga_tindakan}}" id="input-harga-tindakan" class="form-control form-control-alternative{{ $errors->has('harga-tindakan') ? ' is-invalid' : '' }}" placeholder="{{ __('Rp. 00') }}" required disabled>
    
                                        @if ($errors->has('harga-tindakan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('harga-tindakan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('harga-lab') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-harga-lab">{{ __('Harga Lab') }}</label>
                                        <input type="text" name="harga_lab" value="{{$pasien->harga_lab}}" id="input-harga-lab" class="form-control form-control-alternative{{ $errors->has('harga-lab') ? ' is-invalid' : '' }}" placeholder="{{ __('Rp. 00') }}" disabled>
    
                                        @if ($errors->has('harga-lab'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('harga-lab') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <a href="{{route('pasien.index')}}" class="btn btn-danger mt-4">{{ __('Kembali') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
