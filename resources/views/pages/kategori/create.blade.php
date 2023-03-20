@extends('layouts.app', ['title' => __('Buat Kategori Penyakit')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Buat Kategori Penyakit'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        {{-- <div class="row align-items-center"> --}}
                            <h3 class="mb-2">{{ __('Buat Kategori Penyakit') }}</h3>
                        {{-- </div> --}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('kategori.post') }}" autocomplete="off">
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
                                    <div class="form-group p-1 col-lg-12{{ $errors->has('nama_penyakit') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-nama-penyakit">{{ __('Nama penyakit') }}</label>
                                        <input type="text" name="nama_penyakit" id="input-nama-penyakit" class="form-control form-control-alternative{{ $errors->has('nama_penyakit') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama penyakit') }}">

                                        @if ($errors->has('nama_penyakit'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama_penyakit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-12{{ $errors->has('kategori') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-kategori">{{ __('Kategori') }}</label>
                                        <select class="form-control form-control-alternative" name="kategori" id="input-kategori">
                                            <option value="1">Aktif</option>
                                            <option value="2">Tidak aktif</option>
                                        </select>

                                        @if ($errors->has('kategori'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('kategori') }}</strong>
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
