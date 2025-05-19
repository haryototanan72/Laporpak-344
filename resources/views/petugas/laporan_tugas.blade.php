@extends('layouts.adminlayout')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-2">Daftar Tugas Laporan</h2>

    {{-- Form Filter Petugas --}}
    <form method="GET" class="mb-3" action="{{ route('admin.petugas.laporan-tugas.index') }}">
        <div class="row g-2 align-items-center">
            <div class="col-auto fw-semibold">Pilih Petugas:</div>
            <div class="col-auto">
                <select name="petugas_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Pilih Petugas --</option>
                    @foreach($petugasList as $petugas)
                        <option value="{{ $petugas->id }}" {{ (isset($petugasId) && $petugasId == $petugas->id) ? 'selected' : '' }}>
                            {{ $petugas->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    {{-- Nama Petugas --}}
    @if(isset($petugasSelected))
        <div class="mb-2">
            <span class="fw-semibold">Petugas:</span> {{ $petugasSelected->nama }}
        </div>
    @endif

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Tugas --}}
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Nomor Laporan</th>
                <th>Deskripsi</th>
                <th>Status Verifikasi</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tugas as $item)
                <tr>
                    <td>{{ $item->laporan->nomor_laporan ?? '-' }}</td>
                    <td>{{ $item->laporan->deskripsi ?? '-' }}</td>
                    <td>{{ $item->status_verifikasi ?? '-' }}</td>

                    {{-- Form Update --}}
                    <td colspan="2">
                        <form action="{{ route('admin.petugas.laporan-tugas.update', $item->id) }}" method="POST" class="d-flex align-items-center gap-2">
                            @csrf
                            @method('PUT')

                            <select name="kondisi_lapangan" class="form-select form-select-sm" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="Darurat" {{ $item->kondisi_lapangan == 'Darurat' ? 'selected' : '' }}>Darurat</option>
                                <option value="Perlu Diperbaiki" {{ $item->kondisi_lapangan == 'Perlu Diperbaiki' ? 'selected' : '' }}>Perlu Diperbaiki</option>
                                <option value="Ringan" {{ $item->kondisi_lapangan == 'Ringan' ? 'selected' : '' }}>Ringan</option>
                            </select>

                            <div class="btn-group btn-group-sm" role="group">
                                <button name="status" value="diterima" type="submit" class="btn btn-primary {{ $item->status_verifikasi == 'diterima' ? 'active' : '' }}">
                                    Diterima
                                </button>
                                <button name="status" value="ditolak" type="submit" class="btn btn-danger {{ $item->status_verifikasi == 'ditolak' ? 'active' : '' }}">
                                    Ditolak
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada tugas laporan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
