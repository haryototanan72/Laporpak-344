@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">LACAK LAPORANMU</h2>
        <p class="text-muted">Sudah bikin laporan belum? Kalau sudah, Masukkan Nomor Laporanmu dibawah ini!</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('track.search') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="text" 
                        class="form-control form-control-lg" 
                        name="nomor_laporan" 
                        placeholder=""
                        style="border-radius: 8px; border: 1px solid #e0e0e0; background-color: white;">
                </div>
                <button type="submit" class="btn w-100" 
                    style="background-color: #fbb03b; color: white; border-radius: 8px; padding: 12px;">
                    Cari Laporan
                </button>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="d-flex justify-content-between position-relative">
                <!-- Line connector -->
                <div class="position-absolute" style="top: 25px; left: 50px; right: 50px; height: 2px; background-color: #e0e0e0; z-index: 1;"></div>

                <!-- Tulis Laporan -->
                <div class="text-center position-relative" style="z-index: 2; width: 150px;">
                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background-color: #fbb03b;">
                        <i class="bi bi-pencil-fill text-white"></i>
                    </div>
                    <h6 class="mb-2">Tulis Laporan</h6>
                    <p class="text-muted small" style="font-size: 0.8rem;">Laporkan keluhan atau aspirasi anda dengan jelas dan lengkap</p>
                </div>

                <!-- Proses Verifikasi -->
                <div class="text-center position-relative" style="z-index: 2; width: 150px;">
                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background-color: #e0e0e0;">
                        <i class="bi bi-check-circle-fill text-white"></i>
                    </div>
                    <h6 class="mb-2">Proses Verifikasi</h6>
                    <p class="text-muted small" style="font-size: 0.8rem;">Dalam 2 hari laporan Anda akan diverifikasi dan diteruskan kepada instansi berwenang</p>
                </div>

                <!-- Laporan Anda Disetujui -->
                <div class="text-center position-relative" style="z-index: 2; width: 150px;">
                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background-color: #e0e0e0;">
                        <i class="bi bi-file-check text-white"></i>
                    </div>
                    <h6 class="mb-2">Laporan Anda Disetujui</h6>
                    <p class="text-muted small" style="font-size: 0.8rem;">Silahkan tunggu proses selanjutnya</p>
                </div>

                <!-- Proses Tindak Lanjut -->
                <div class="text-center position-relative" style="z-index: 2; width: 150px;">
                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background-color: #e0e0e0;">
                        <i class="bi bi-gear text-white"></i>
                    </div>
                    <h6 class="mb-2">Proses Tindak lanjut</h6>
                    <p class="text-muted small" style="font-size: 0.8rem;">Laporan sedang diproses harap tunggu program pembangunan</p>
                </div>

                <!-- Beri Tanggapan -->
                <div class="text-center position-relative" style="z-index: 2; width: 150px;">
                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background-color: #e0e0e0;">
                        <i class="bi bi-chat-dots text-white"></i>
                    </div>
                    <h6 class="mb-2">Beri Tanggapan</h6>
                    <p class="text-muted small" style="font-size: 0.8rem;">Anda dapat menanggapi umpan balik</p>
                </div>

                <!-- Selesai -->
                <div class="text-center position-relative" style="z-index: 2; width: 150px;">
                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background-color: #e0e0e0;">
                        <i class="bi bi-check2-circle text-white"></i>
                    </div>
                    <h6 class="mb-2">Selesai</h6>
                    <p class="text-muted small" style="font-size: 0.8rem;">Laporan Anda akan terus ditindaklanjuti hingga terselesaikan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-5">
        <button class="btn" 
            style="background-color: #fbb03b; color: white; padding: 8px 30px;"
            onclick="window.history.back()">
            Kembali
        </button>
    </div>
</div>

@push('scripts')
<style>
.bi {
    font-size: 1.5rem;
}
</style>
@endpush

@endsection
