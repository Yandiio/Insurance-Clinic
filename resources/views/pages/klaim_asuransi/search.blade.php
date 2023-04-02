@extends('layouts.section')

@section('subheader')
<div class="container-fluid">
    <div class="header-body">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Klaim Asuransi</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Klaim Asuransi</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="{{route('klaimasuransi.export')}}" class="btn btn-sm btn-neutral">Export</a>
                <a href="{{route('klaimasuransi.create')}}" class="btn btn-sm btn-neutral">Tambah</a>
                <a href="#" data-toggle="dropdown" class="btn btn-sm btn-neutral">Filter</a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Filter') }}</h6>
                    </div>
                    <form method="post" action="{{route('klaimasuransi.search')}}">
                        @csrf
                        @method('post')
                        <div class="dropdown-item">
                            <label class="form-control-label" for="status-klaim">{{ __('Status') }}</label>
                            <select class="form-control form-control-alternative" name="status" id="status-klaim">
                                <option value="1">Belum di klaim</option>
                                <option value="2">Menunggu Permohonan</option>
                                <option value="3">Sudah di klaim</option>
                            </select>                        
                        </div>
                        <div class="dropdown-item">
                            <label class="form-control-label" for="pencarian">{{ __('Pencarian') }}</label>
                            <input type="text" name="pencarian" id="pencarian" class="form-control form-control-alternative{{ $errors->has('pencarian') ? ' is-invalid' : '' }}" placeholder="{{ __('Pencarian') }}">
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item row">
                            <button type="submit" style="margin-left: 10px;" class="btn btn-primary">
                                <span>Cari</span>
                            </button>
                            <a href="{{route('klaimasuransi.index')}}" style="margin-left: 5px; color: white;" class="btn btn-danger">
                                <span>Reset</span>
                            </a>
                        </div>
                    </form>
                </div>
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
                <h3 class="mb-0">Klaim Asuransi</h3>
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
                        @foreach ($klaim_asuransi as $item)
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
                                {{-- - --}}
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
                                        <a class="dropdown-item" href="{{ route('klaimasuransi.edit', $item->id)}}">Edit</a>
                                        <a class="dropdown-item" href="{{ route('klaimasuransi.view', $item->id)}}">View</a>
                                        <a class="dropdown-item" href="{{ route('klaimasuransi.destroy', $item->id)}}">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Card footer -->
            <div class="card-footer py-4">
                <nav aria-label="...">
                    <ul class="pagination justify-content-end mb-0">
                         {{$klaim_asuransi->links()}}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
