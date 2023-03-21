@extends('layouts.app', ['title' => __('Buat Tipe Asuransi')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Buat Tipe Asuransi'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        {{-- <div class="row align-items-center"> --}}
                            <h3 class="mb-2">{{ __('Buat Tipe Asuransi') }}</h3>
                        {{-- </div> --}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('tipe_asuransi.post') }}" autocomplete="off">
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
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('nama') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-gol-darah">{{ __('Nama') }}</label>
                                        <input type="text" name="nama" id="input-gol-darah" class="form-control form-control-alternative{{ $errors->has('nama') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama') }}" required>
    
                                        @if ($errors->has('nama'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('kode_asuransi') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-kode-asuransi">{{ __('Kode Asuransi    ') }}</label>
                                        <input type="text" name="kode_asuransi" id="input-kode-asuransi" class="form-control form-control-alternative{{ $errors->has('kode_asuransi') ? ' is-invalid' : '' }}" placeholder="{{ __('ex: IJ001') }}" required>
    
                                        @if ($errors->has('kode_asuransi'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('kode_asuransi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email">{{ __('E-mail') }}</label>
                                        <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-mail') }}">
    
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('telepon') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-telepon">{{ __('Telepon') }}</label>
                                        <input type="text" name="telepon" id="input-telepon" class="form-control form-control-alternative{{ $errors->has('telepon') ? ' is-invalid' : '' }}" placeholder="{{ __('Telepon') }}">
    
                                        @if ($errors->has('telepon'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('telepon') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-12{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                                        <input type="text" name="alamat" id="input-alamat" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}">

                                        @if ($errors->has('alamat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('alamat') }}</strong>
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
