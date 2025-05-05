@extends('layouts.app', ['noScripts' => true])
@section('content')
<style>
    body > header, body > nav, body > .header, body > .navbar, body > .navmenu { display: none !important; }
    .custom-show-container {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        max-width: 700px;
    }
    .custom-title {
        color: #222;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .detail-label {
        min-width: 140px;
        color: #444;
        font-weight: 500;
    }
    .detail-value {
        color: #222;
    }
    .detail-row {
        padding: 7px 0 7px 0;
        border-bottom: 1px solid #f0f0f0;
    }
</style>
<div class="d-flex justify-content-center align-items-center min-vh-100" style="background:#f7f7f7; padding-top:40px; padding-bottom:40px;">
    <div class="card shadow-lg p-4 custom-show-container w-100">
    <div class="d-flex align-items-center mb-4" style="gap: 18px;">
        <a href="{{ route('laporan.index') }}" style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#ffb347,#ff5858);box-shadow:0 2px 10px #ffb34733;border:none;text-decoration:none;">
            <span style="color:white;font-size:1.6rem;line-height:1;"><i class="fa fa-chevron-left"></i></span>
        </a>
        <div class="flex-grow-1 text-center">
            <span style="display:inline-block;font-size:2rem;font-weight:700;background:linear-gradient(90deg,#ffb347,#ff5858);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Detail Laporan</span>
        </div>
        <div style="width:48px;"></div> <!-- Spacer agar judul tetap center -->
    </div>
    <hr>
        <div class="mb-3">
            <div class="row detail-row">
                <div class="col-4 detail-label">Nomor Laporan</div>
                <div class="col-8 detail-value">{{ $laporan->nomor_laporan }}</div>
            </div>
            <div class="row detail-row">
                <div class="col-4 detail-label">Jenis</div>
                <div class="col-8 detail-value">{{ $laporan->jenis_laporan }}</div>
            </div>
            <div class="row detail-row">
                <div class="col-4 detail-label">Kategori</div>
                <div class="col-8 detail-value">{{ $laporan->kategori }}</div>
            </div>
            <div class="row detail-row">
                <div class="col-4 detail-label">Lokasi</div>
                <div class="col-8 detail-value">{{ $laporan->lokasi }}</div>
            </div>
            <div class="row detail-row">
                <div class="col-4 detail-label">Ciri Khusus</div>
                <div class="col-8 detail-value">{{ $laporan->ciri_khusus ?? '-' }}</div>
            </div>
            <div class="row detail-row">
                <div class="col-4 detail-label">Deskripsi</div>
                <div class="col-8 detail-value">{{ $laporan->deskripsi }}</div>
            </div>
            <div class="row detail-row">
                <div class="col-4 detail-label">Status</div>
                <div class="col-8 detail-value">{{ $laporan->status }}</div>
            </div>
            <div class="row detail-row">
                <div class="col-4 detail-label">Tanggal Diajukan</div>
                <div class="col-8 detail-value">{{ $laporan->created_at->format('d-m-Y H:i') }}</div>
            </div>
            <div class="row detail-row">
                <div class="col-4 detail-label">Tanggal Diperbarui</div>
                <div class="col-8 detail-value">{{ $laporan->updated_at->format('d-m-Y H:i') }}</div>
            </div>
            <div class="row detail-row align-items-center">
                <div class="col-4 detail-label">Bukti Laporan</div>
                <div class="col-8 detail-value">
                    @if($laporan->bukti_laporan)
                        @php
                            $extension = pathinfo($laporan->bukti_laporan, PATHINFO_EXTENSION);
                            $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']);
                        @endphp
                        
                        @if($isVideo)
                            <video controls style="width:100%;max-width:100%;max-height:400px;border-radius:12px;border:1px solid #e3e3e3;">
                                <source src="{{ asset('storage/'.$laporan->bukti_laporan) }}" type="video/{{ $extension }}">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <img src="{{ asset('storage/'.$laporan->bukti_laporan) }}" alt="Bukti Laporan" style="width:100%;max-width:100%;max-height:400px;object-fit:contain;border-radius:12px;border:1px solid #e3e3e3;">
                        @endif
                    @else
                        <span class="text-muted">Tidak ada bukti</span>
                    @endif
                </div>
            </div>
            </dl>
        </div>
    </div>
</div>
@endsection
