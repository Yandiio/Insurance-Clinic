@extends('layouts.section')

@section('header')
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Search form -->
    <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
        <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
            </div>
        </div>
        <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
            aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </form>
</div>
@endsection

@section('subheader')
<div class="container-fluid">
    <div class="header-body">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Reimburse</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reimburse</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="#" class="btn btn-sm btn-neutral">Export</a>
                <a href="{{route('klaimasuransi.create')}}" class="btn btn-sm btn-neutral">Tambah</a>
                <a href="#" class="btn btn-sm btn-neutral">Filter</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Reimburse</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">No</th>
                            <th scope="col" class="sort" data-sort="budget">Nomor Klaim</th>
                            <th scope="col" class="sort" data-sort="budget">Nama Pasien</th>
                            <th scope="col" class="sort" data-sort="budget">Asuransi</th>
                            <th scope="col" class="sort" data-sort="budget">Status Klaim</th>
                            <th scope="col" class="sort" data-sort="budget">Obat</th>
                            <th scope="col" class="sort" data-sort="budget">Tindakan</th>
                            <th scope="col" class="sort" data-sort="budget">Lab</th>
                            <th scope="col" class="sort" data-sort="completion">Aksi</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $i = 1; ?>
                        @foreach ($reimburse as $item)
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <span class="name mb-0 text-sm">{{$i}} </span>
                                </div>
                            </th>
                            <td>
                                {{ $item->no_klaim }}
                            </td>
                            <td>
                                {{ $item->pasien->nama_lengkap }}
                            </td>
                            <td>
                                {{ $item->asuransi->nama }}
                            </td>
                            <td>
                                {{ $item->statusKlaim->status }}
                            </td>
                            <td>
                                {{ $item->obat }}
                            </td>
                            <td>
                                {{ $item->tindakan }}
                            </td>
                            <td>
                                {{ $item->lab }}
                            </td>
                            <td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a id="konfirm-modal" class="dropdown-item" data-toggle="modal" data-konfirmasi-id="{{$item->id}}" data-target="#modalKonfirmasi">Klaim</a>
                                        <a class="dropdown-item" href="{{ route('klaimasuransi.view', $item->id)}}">View</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="labelModalKonfirmasi" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalKonfirmasi">Konfirmasi Klaim Asuransi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Apakah anda yakin akan reimburse data?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" id="konfirmasi" class="btn btn-primary">Klaim Asuransi</button>
                    </div>
                  </div>
                </div>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
                <nav aria-label="...">
                    <ul class="pagination justify-content-end mb-0">
                         {{$reimburse->links()}}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        
        let data = null;

        $('#konfirm-modal').click(function(e) {
            data = this.dataset.konfirmasiId;
        });


        $('#konfirmasi').click(function(e) {
            console.log(data);
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '{{ route('reimburse.klaim') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: data,
                },
                success: function(data) {
                    alert('data berhasil diproses');
                }, 
                error: function(err) {
                    alert('data tidak dapat diproses');
                }
            });
        });
   });
</script>

