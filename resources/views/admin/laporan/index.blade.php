@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Semua Laporan</h2>

    <form method="GET" action="{{ route('admin.laporan.index') }}">
        <div>
            <label>Status:</label>
            <select name="status">
                <option value="">-- Semua --</option>
                <option value="dikirim">Dikirim</option>
                <option value="diterima">Diterima</option>
                <option value="diproses">Diproses</option>
                <option value="selesai">Selesai</option>
                <option value="ditolak">Ditolak</option>
            </select>

            <label>Tanggal:</label>
            <input type="date" name="tanggal">

            <label>Urutkan:</label>
            <select name="sort">
                <option value="terbaru">Terbaru</option>
                <option value="prioritas">Prioritas</option>
                <option value="status">Status</option>
            </select>

            <button type="submit">Filter</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $laporan)
            <tr>
                <td>{{ $laporan->id_laporan }}</td>
                <td>{{ $laporan->lokasi }}</td>
                <td>{{ $laporan->tanggal_lapor }}</td>
                <td>{{ $laporan->status }}</td>
                <td>
                    <a href="#">Lihat</a> |
                    <a href="#">Tindak Lanjut</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
</div>
@endsection
