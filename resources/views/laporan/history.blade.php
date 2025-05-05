@extends('layouts.app', ['noScripts' => true])

@section('content')
<style>
    body > header, body > nav, body > .header, body > .navbar, body > .navmenu { display: none !important; }
    .custom-history-container {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
    }
    .custom-title {
        color: #222;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .btn-back {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(90deg, #ff8c42 0%, #ff3c3c 100%);
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 44px;
        height: 44px;
        justify-content: center;
        box-shadow: 0 2px 8px 0 rgba(255, 140, 66, 0.13);
        font-size: 1.4rem;
        margin-bottom: 18px;
        margin-right: 8px;
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-back:hover, .btn-back:focus {
        background: linear-gradient(90deg, #ff3c3c 0%, #ff8c42 100%);
        color: #fff;
        box-shadow: 0 4px 16px 0 rgba(255, 140, 66, 0.18);
        text-decoration: none;
    }
    .btn-back svg {
        width: 22px;
        height: 22px;
        vertical-align: middle;
    }
    .custom-table th, .custom-table td {
        vertical-align: middle !important;
        text-align: center;
    }
    .btn-navy {
        background: transparent !important;
        color: #182848 !important;
        border: 2px solid transparent;
        box-shadow: none;
        padding: 0.375rem 0.6rem;
    }
    .btn-navy:hover {
        background: transparent !important;
        color: #0f1731 !important;
        border: 2px solid transparent;
        box-shadow: none;
    }
    .btn-navy:hover {
        background: #0f1731;
        color: #fff;
    }
    .btn-edit-custom {
        background: #fff;
        color: #ffc107;
        border: 1.5px solid #ffc107;
        transition: all 0.2s;
    }
    .btn-edit-custom:hover {
        background: #ffc107;
        color: #fff;
        border-color: #ffc107;
    }
    .btn-delete-custom {
        background: #fff;
        color: #dc3545;
        border: 1.5px solid #dc3545;
        transition: all 0.2s;
    }
    .btn-delete-custom:hover {
        background: #dc3545;
        color: #fff;
        border-color: #dc3545;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="d-flex justify-content-center align-items-center min-vh-100" style="background:#f7f7f7;">
    <div class="card shadow-lg p-4 custom-history-container" style="width:100%; max-width:700px;">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('user.dashboard') }}" class="btn btn-back" title="Kembali">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </a>
            <h2 class="flex-grow-1 text-center custom-title">Laporan Saya</h2>
            <div></div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered custom-table mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Nomor Laporan</th>
                        <th>Tanggal</th>
                        <th style="width:120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporans as $laporan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $laporan->nomor_laporan }}</td>
                        <td>{{ $laporan->created_at->format('d-m-Y') }}</td>
                        <td>
    <div class="d-flex justify-content-center align-items-center gap-1 flex-nowrap">
        <a href="{{ route('laporan.show', $laporan->id) }}" class="btn btn-navy btn-sm" title="Lihat"><i class="fa fa-eye"></i></a>
        <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-edit-custom btn-sm" title="Edit">Edit</a>
        <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-delete-custom btn-sm btn-hapus-laporan" title="Hapus">Hapus</button>
        </form>
    </div>
</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($laporans->isEmpty())
            <div class="alert alert-info mt-3">Belum ada laporan yang Anda buat.</div>
        @endif
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/history.js') }}"></script>
@endsection
