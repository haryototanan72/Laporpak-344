@extends('layouts.adminlayout')

@section('title', 'Dashboard Admin - LaporPak')

@section('header')
    <span>Admin</span>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Status Detail -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Status Laporan</h5>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="small-box bg-secondary p-3 rounded">
                                    <div class="inner">
                                        <h3>{{ $statusLaporan['diajukan'] }}</h3>
                                        <p>Diajukan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="small-box bg-info p-3 rounded">
                                    <div class="inner">
                                        <h3>{{ $statusLaporan['diverifikasi'] }}</h3>
                                        <p>Diverifikasi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="small-box bg-primary p-3 rounded">
                                    <div class="inner">
                                        <h3>{{ $statusLaporan['diterima'] }}</h3>
                                        <p>Diterima</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="small-box bg-danger p-3 rounded">
                                    <div class="inner">
                                        <h3>{{ $statusLaporan['ditolak'] }}</h3>
                                        <p>Ditolak</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="small-box bg-warning p-3 rounded">
                                    <div class="inner">
                                        <h3>{{ $statusLaporan['ditindaklanjuti'] }}</h3>
                                        <p>Ditindaklanjuti</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="small-box bg-info p-3 rounded">
                                    <div class="inner">
                                        <h3>{{ $statusLaporan['ditanggapi'] }}</h3>
                                        <p>Ditanggapi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="small-box bg-success p-3 rounded">
                                    <div class="inner">
                                        <h3>{{ $statusLaporan['selesai'] }}</h3>
                                        <p>Selesai</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Reports -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Terbaru</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No. Laporan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laporanTerbaru as $laporan)
                                    <tr>
                                        <td>{{ $laporan->nomor_laporan }}</td>
                                        <td>{{ $laporan->created_at->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($laporan->status == 'diajukan') bg-secondary
                                                @elseif($laporan->status == 'diverifikasi') bg-info
                                                @elseif($laporan->status == 'diterima') bg-primary
                                                @elseif($laporan->status == 'ditolak') bg-danger
                                                @elseif($laporan->status == 'ditindaklanjuti') bg-warning
                                                @elseif($laporan->status == 'ditanggapi') bg-info
                                                @elseif($laporan->status == 'selesai') bg-success
                                                @endif">
                                                {{ ucfirst($laporan->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.laporan.detail', $laporan->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
