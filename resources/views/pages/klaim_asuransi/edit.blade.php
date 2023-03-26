@extends('layouts.app', ['title' => __('Detail Klaim Asuransi')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Detail Klaim Asuransi'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        {{-- <div class="row align-items-center"> --}}
                            <h3 class="mb-2">{{ __('Buat Klaim Asuransi') }}</h3>
                        {{-- </div> --}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('klaimasuransi.update', $already_claim->id)}}" autocomplete="off">
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
                                        <label class="form-control-label" for="input-nama-lengkap">{{ __('Nama') }}</label>
                                        <select class="form-control form-control-alternative" name="nama_lengkap" id="input-nama-lengkap">
                                            @foreach ($pasien as $item)
                                              <option value="{{$item->id}}">{{$item->nama_lengkap}}</option>
                                            @endforeach
                                        </select>
    
                                        @if ($errors->has('nama_lengkap'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama_lengkap') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('nik') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-nik">{{ __('NIK') }}</label>
                                        <input type="nik" value="{{$pasien_claim->nik}}" name="nik" id="input-nik" class="form-control form-control-alternative{{ $errors->has('nik') ? ' is-invalid' : '' }}" placeholder="{{ __('NIK') }}"  >
    
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
                                        <input type="text" value="{{$pasien_claim->tempat_lahir}}" name="tempat_lahir" id="input-tempat-lahir" class="form-control form-control-alternative{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempat lahir') }}" >
    
                                        @if ($errors->has('tempat_lahir'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('tanggal_lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-tanggal-lahir">{{ __('Tanggal Lahir') }}</label>
                                        <input type="date" value="{{$pasien_claim->tanggal_lahir}}" name="tanggal_lahir" id="input-tanggal-lahir" class="form-control form-control-alternative{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tanggal lahir') }}" >
    
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
                                        <select class="form-control form-control-alternative" name="jenis_kelamin" id="input-jenis-kelamin" >
                                            <option>{{$pasien_claim->jenis_kelamin}}</option>
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
                                        <input type="text" value="{{$pasien_claim->golongan_darah}}" name="golongan_darah" id="input-gol-darah" class="form-control form-control-alternative{{ $errors->has('golongan-darah') ? ' is-invalid' : '' }}" placeholder="{{ __('Golongan Darah') }}" >
    
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                                        <input type="text" value="{{$pasien_claim->alamat}}" name="alamat" id="input-alamat" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" >
    
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
                                        <input type="number" value="{{$pasien_claim->usia}}" name="usia" id="input-usia" class="form-control form-control-alternative{{ $errors->has('usia') ? ' is-invalid' : '' }}" placeholder="{{ __('Usia') }}" >
    
                                        @if ($errors->has('usia'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('usia') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <hr class="my-4" />

                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-12 {{ $errors->has('tipe-asuransi') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-tipe-asuransi">{{ __('Tipe Asuransi') }}</label>
                                        <select class="form-control form-control-alternative" name="tipe_asuransi" id="input-tipe-asuransi" >
                                            @foreach ($asuransi as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
    
                                        @if ($errors->has('tipe-asuransi'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tipe-asuransi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <hr class="my-4" />

                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('obat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-obat">{{ __('Obat') }}</label>
                                        <input type="text" value="{{$already_claim->obat}}" name="obat" id="input-obat" class="form-control form-control-alternative{{ $errors->has('obat') ? ' is-invalid' : '' }}" placeholder="{{ __('Obat') }}" >
    
                                        @if ($errors->has('obat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('obat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('tindakan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-tindakan">{{ __('Tindakan') }}</label>
                                        <input type="text" value="{{$already_claim->tindakan}}" name="tindakan" id="input-tindakan" class="form-control form-control-alternative{{ $errors->has('tindakan') ? ' is-invalid' : '' }}" placeholder="{{ __('Tindakan') }}" >
    
                                        @if ($errors->has('tindakan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tindakan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('lab') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-lab">{{ __('Lab') }}</label>
                                        <input type="text" value="{{$already_claim->lab}}" name="lab" id="input-lab" class="form-control form-control-alternative{{ $errors->has('lab') ? ' is-invalid' : '' }}" placeholder="{{ __('Lab') }}">
    
                                        @if ($errors->has('lab'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lab') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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
