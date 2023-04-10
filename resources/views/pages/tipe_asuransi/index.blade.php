@extends('layouts.section')

@section('subheader')
<div class="container-fluid">
    <div class="header-body">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Tipe Asuransi</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a>Data Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tipe Asuransi</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="{{route('tipe_asuransi.create')}}" class="btn btn-sm btn-neutral">Tambah</a>
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
                <h3 class="mb-0">Tipe Asuransi</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">No</th>
                            <th scope="col" class="sort" data-sort="budget">Nama Asuransi</th>
                            <th scope="col" class="sort" data-sort="budget">Kode Asuransi</th>
                            <th scope="col" class="sort" data-sort="budget">No. Telepon</th>
                            <th scope="col" class="sort" data-sort="budget">E-mail</th>
                            <th scope="col" class="sort" data-sort="budget">Alamat</th>
                            <th scope="col" class="sort" data-sort="completion">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $i = 1; ?>
                        @foreach ($tipe_asuransi as $item)
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <span class="name mb-0 text-sm">{{$i}} </span>
                                </div>
                            </th>
                            <td>
                                {{ $item->nama }}
                            </td>
                            <td>
                                {{ $item->kode_asuransi }}
                            </td>
                            <td>
                                {{ $item->telepon }}
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>
                            <td>
                                {{ $item->alamat }}
                            </td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ route('tipe_asuransi.edit', $item->id)}}">Edit</a>
                                        <a class="dropdown-item" href="{{ route('tipe_asuransi.view', $item->id)}}">View</a>
                                        <a class="dropdown-item" href="{{ route('tipe_asuransi.destroy', $item->id)}}">Delete</a>
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
                         {{$tipe_asuransi->links()}}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
