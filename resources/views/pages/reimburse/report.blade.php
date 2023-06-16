@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')
    
    <div class="container-fluid mt-7">
        <div class="row">
            {{-- <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Menunggu Permohonan</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{route('klaimasuransi.index')}}" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Jenis Asuransi</th>
                                    <th scope="col">Dilayani Oleh</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menunggu_permohonan as $item)
                                    <tr>
                                        <th scope="row">
                                            {{$item->nama_pasien}}
                                        </th>
                                        <td>
                                            {{$item->tipe_asuransi}}
                                        </td>
                                        <td>
                                            {{$item->staff}}
                                        </td>
                                        <td>
                                            {{$item->status}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                {{-- <h6 class="text-uppercase text-muted ls-1 mb-1">Hasil</h6> --}}
                                <h2 class="mb-0">Jumlah Klaim</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart" data-canvas="{{route('reimburse-chart')}}">
                            <canvas id="chart-orders" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Klaim Asuransi</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nama Asuransi</th>
                                    <th scope="col">Jumlah Klaim</th>
                                    <th scope="col">Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($persentase_asuransi as $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $item->nama }}
                                        </th>
                                        <td>
                                            {{ $item->jumlah }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">{{ round($item->persentasi, 0).'%' }}</span>
                                                <div>
                                                    <div class="progress">
                                                    <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="{{ round($item->persentasi, 0)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ round($item->persentasi, 0)}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5    ">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Total Klaim (per bulan)</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Bulan</th>
                                    <th scope="col">Total (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendapatan as $item)
                                    <tr>
                                        <th scope="row">
                                            {{$item->bulan.' '.$item->year}}
                                        </th>
                                        <td>
                                            {{$item->jumlah_bayaran}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush