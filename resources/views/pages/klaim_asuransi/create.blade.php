@extends('layouts.app', ['title' => __('Buat Klaim Asuransi')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Buat Klaim Asuransi'),
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
                        <form method="post" action="{{ route('klaimasuransi.post') }}" autocomplete="off">
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
                                            <option value="">Pilih Pasien </option>
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
                                        <input type="nik" name="nik" id="input-nik" class="form-control form-control-alternative{{ $errors->has('nik') ? ' is-invalid' : '' }}" placeholder="{{ __('NIK') }}" >
    
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
                                        <input type="text" name="tempat_lahir" id="input-tempat-lahir" class="form-control form-control-alternative{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempat lahir') }}">
    
                                        @if ($errors->has('tempat_lahir'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('tanggal_lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-tanggal-lahir">{{ __('Tanggal Lahir') }}</label>
                                        <input type="date" name="tanggal_lahir" id="input-tanggal-lahir" class="form-control form-control-alternative{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tanggal lahir') }}">
    
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
                                        <select class="form-control form-control-alternative" name="jenis_kelamin" id="input-jenis-kelamin">
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
                                        <input type="text" name="golongan_darah" id="input-gol-darah" class="form-control form-control-alternative{{ $errors->has('golongan-darah') ? ' is-invalid' : '' }}" placeholder="{{ __('Golongan Darah') }}" >
    
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                                        <input type="text" name="alamat" id="input-alamat" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" >
    
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
                                        <input type="number" name="usia" id="input-usia" class="form-control form-control-alternative{{ $errors->has('usia') ? ' is-invalid' : '' }}" placeholder="{{ __('Usia') }}" >
    
                                        @if ($errors->has('usia'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('usia') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('agama') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-agama">{{ __('Agama') }}</label>
                                        <input type="text" id="input-agama" class="form-control form-control-alternative{{ $errors->has('agama') ? ' is-invalid' : '' }}" placeholder="{{ __('Agama') }}" >
    
                                        @if ($errors->has('agama'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('agama') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <hr class="my-4" />

                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-12 {{ $errors->has('tipe_asuransi') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-tipe-asuransi">{{ __('Tipe Asuransi') }}</label>
                                        <select class="form-control form-control-alternative" name="tipe_asuransi" id="input-tipe-asuransi">
                                            <option value="">Pilih Asuransi </option>
                                            @foreach ($asuransi as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
    
                                        @if ($errors->has('tipe_asuransi'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tipe_asuransi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <hr class="my-4" />

                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('obat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-obat">{{ __('Obat') }}</label>
                                        <input type="text" name="obat" id="input-obat" class="form-control form-control-alternative{{ $errors->has('obat') ? ' is-invalid' : '' }}" placeholder="{{ __('Obat') }}">
    
                                        @if ($errors->has('obat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('obat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('harga_obat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-harga-obat">{{ __('Harga Obat') }}</label>
                                        <input type="text" name="harga_obat" id="input-harga-obat" class="form-control form-control-alternative{{ $errors->has('obat') ? ' is-invalid' : '' }}" placeholder="{{ __('Harga Obat') }}">
    
                                        @if ($errors->has('harga_obat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('harga_obat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('lab') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-lab">{{ __('Lab') }}</label>
                                        <input type="text" name="lab" id="input-lab" class="form-control form-control-alternative{{ $errors->has('lab') ? ' is-invalid' : '' }}" placeholder="{{ __('Lab') }}">
    
                                        @if ($errors->has('lab'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lab') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('harga_lab') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-harga-lab">{{ __('Harga Lab') }}</label>
                                        <input type="text" name="harga_lab" id="input-harga-lab" class="form-control form-control-alternative{{ $errors->has('harga_lab') ? ' is-invalid' : '' }}" placeholder="{{ __('Harga Lab') }}">
    
                                        @if ($errors->has('harga_lab'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('harga_lab') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('tindakan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-tindakan">{{ __('Tindakan') }}</label>
                                        <input type="text" name="tindakan" id="input-tindakan" class="form-control form-control-alternative{{ $errors->has('tindakan') ? ' is-invalid' : '' }}" placeholder="{{ __('Tindakan') }}" >
    
                                        @if ($errors->has('tindakan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tindakan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('harga_tindakan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-harga-tindakan">{{ __('Harga Tindakan') }}</label>
                                        <input type="text" name="harga_tindakan" id="input-harga-tindakan" class="form-control form-control-alternative{{ $errors->has('harga_tindakan') ? ' is-invalid' : '' }}" placeholder="{{ __('Harga Tindakan') }}" >
    
                                        @if ($errors->has('harga_tindakan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('harga_tindakan') }}</strong>
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

<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#input-nama-lengkap').click(function(e) {
            let val = $(this).val();

            $.ajax({
                type: 'get',
                url: '{{route('pasien.find')}}',
                data: {
                    id: val,
                },
                success: function(res) {
                    let result = res.data;
                    let splitDate = result.tanggal_lahir;

                    let parts = splitDate.split("/").reverse().reverse().join('-');

                    document.getElementById('input-nik').value = result.nik;
                    document.getElementById('input-jenis-kelamin').value = result.jenis_kelamin;
                    document.getElementById('input-tempat-lahir').value = result.tempat_lahir;
                    document.getElementById('input-gol-darah').value = result.golongan_darah;
                    document.getElementById('input-tanggal-lahir').value = parts;
                    document.getElementById('input-alamat').value = result.alamat;
                    document.getElementById('input-harga-tindakan').value = result.harga_tindakan;
                    document.getElementById('input-harga-lab').value = result.harga_lab;
                    document.getElementById('input-harga-obat').value = result.harga_obat;
                    document.getElementById('input-usia').value = result.usia;
                    document.getElementById('input-agama').value = result.agama;
                }, 
                error: function(err) {
                    alert("data tidak ditemukan");
                }
            });
        });
   });
</script>
