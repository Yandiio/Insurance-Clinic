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
                                        <select class="form-control form-control-alternative" name="nama_pasien" id="input-nama-lengkap">
                                            <option value="">-- Pilih Pasien --</option>
                                            @foreach ($pasien as $item)
                                              <option value="{{$item->id}}" {{ $item->id === $pasien_claim->id ? 'selected' : '' }}>{{$item->nama_lengkap}}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="nama" id="input-nama" hidden>
    
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
                                            <option value="Laki-laki" {{$pasien_claim->jenis_kelamin == 'Laki-laki' ? 'selected' : "" }}>Laki-laki</option>
                                            <option value="Perempuan" {{$pasien_claim->jenis_kelamin == 'Perempuan' ? 'selected' : "" }}>Perempuan</option>
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
                                                <option value="{{$item->id}}" {{$asuransi_claim->id == $item->id ? 'selected' : ''}}>{{$item->nama}}</option>
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
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('harga_obat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-harga-obat">{{ __('Harga Obat') }}</label>
                                        <input type="number" value="{{$pasien_claim->harga_obat}}" name="harga-obat" id="input-harga-obat" class="form-control form-control-alternative{{ $errors->has('harga_obat') ? ' is-invalid' : '' }}" placeholder="{{ __('Harga Obat') }}" >
    
                                        @if ($errors->has('harga_obat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('obat') }}</strong>
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
                                    <div class="form-group p-1 col-lg-6 {{ $errors->has('harga_tindakan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-harga-tindakan">{{ __('Harga Tindakan') }}</label>
                                        <input type="number" value="{{$pasien_claim->harga_tindakan}}" name="harga-tindakan" id="input-harga-tindakan" class="form-control form-control-alternative{{ $errors->has('harga_tindakan') ? ' is-invalid' : '' }}" placeholder="{{ __('Harga Tindakan') }}" >
    
                                        @if ($errors->has('harga_tindakan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('harga_tindakan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
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
        $('.dropdown-menu').click(function(e) {
            e.stopPropagation();
        });

        $('#input-nama-lengkap').select2({
            placeholder: 'Pilih nama'
        });

        $('#input-nama-lengkap').on("select2:select", function(e) {
            var data = e.params.data;
            console.log(data.id);

            $.ajax({
                type: 'get',
                url: '{{ route('klaimasuransi.show') }}',
                crossDomain: true,
                xhrFields: {
                    withCredentials: true
                },
                data: {
                    id: data.id,
                },
                success: function(res) {
                    let result = res;
                    let splitDate = result.tanggal_lahir;


                    let parts = splitDate.split("/").reverse().reverse().join('-');

                    document.getElementById('input-nik').value = result.nik;
                    document.getElementById('input-nama').value = result.nama_lengkap;
                    $('#input-jenis-kelamin').val('Laki-laki').change();
                    if (result.jk.toLowerCase() === "perempuan") {
                        $('#input-jenis-kelamin').val('Perempuan').change();
                    }
                    document.getElementById('input-tempat-lahir').value = result.tempat_lahir;
                    document.getElementById('input-gol-darah').value = result.golongan_darah;
                    document.getElementById('input-tanggal-lahir').value = parts;
                    document.getElementById('input-alamat').value = result.alamat_pasien.alamat;
                    document.getElementById('input-tindakan').value = result.pendaftaran.tindakan_diagnosa.hasil_diagnosa;
                    document.getElementById('input-harga-tindakan').value = result.pendaftaran.tindakan_diagnosa.harga;
                    // document.getElementById('input-lab').value = result.harga_lab;
                    document.getElementById('input-obat').value = result.obat.nama_obat;
                    document.getElementById('input-harga-obat').value = result.obat.harga_obat;
                    document.getElementById('input-usia').value = result.usia;
                    document.getElementById('input-agama').value = result.agama;
                }, 
                error: function(err) {
                    alert("data not found");
                }
            });
        });
   });
</script>