@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section id="landing" class="landing section dark-background">
  <img src="{{ asset('assets/img/dashboard-1.png') }}" alt="" class="landing-bg" data-aos="fade-in">
  <section class="min-vh-100 d-flex align-items-center" style="background: url('{{ asset('assets/img/your-background-image.jpg') }}') center center / cover no-repeat;">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-8 d-flex flex-column justify-content-center text-white">
          <h1 class="fw-bold display-4" data-aos="fade-up" data-aos-delay="100">LAYANAN PENGADUAN ONLINE</h1>
          <p class="fs-5" data-aos="fade-up" data-aos-delay="200">
            Laporkan segera saat Anda mempunyai informasi Jalan atau Jembatan Nasional Rusak
          </p>
          <div class="mt-4" data-aos="fade-up" data-aos-delay="300">
            <a href="#" class="btn btn-danger btn-lg me-2 px-4 py-2">LAPOR!</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</section>

<!-- Statistik Section -->
<section class="min-vh-100 d-flex align-items-center position-relative overflow-hidden">
  <img src="{{ asset('assets/img/dashboard-2.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="z-index: 0;" data-aos="fade-in">
  <div class="container position-relative" style="z-index: 1;">
    <div class="row align-items-center">
      <div class="col-md-12 text-center text-md-start">
        <div class="mb-3 mx-auto mx-md-0" style="border-top: 4px solid #EB5757; width: 40px; position: relative; left: 100px;"></div>
        <h2 class="fw-bold text-dark" style="padding-left: 100px;">Statistik<br>LaporPak</h2>
        <div class="row justify-content-center justify-content-md-start text-start mt-4" style="padding-left: 100px;">
          <div class="col-6 col-md-1 mb-3">
            <i class="bi bi-file-earmark-text-fill text-warning fs-2"></i>
            <h5 class="fw-bold mb-0">1001</h5>
            <small class="text-muted fs-6">Jumlah Laporan</small>
          </div>
          <div class="col-6 col-md-1 mb-3">
            <i class="bi bi-list-task text-warning fs-2"></i>
            <h5 class="fw-bold mb-0">489</h5>
            <small class="text-muted fs-6">Baru</small>
          </div>
          <div class="col-6 col-md-1 mb-3">
            <i class="bi bi-gear-fill text-warning fs-2"></i>
            <h5 class="fw-bold mb-0">399</h5>
            <small class="text-muted fs-6">Proses Verifikasi</small>
          </div>
          <div class="col-6 col-md-1 mb-3">
            <i class="bi bi-file-earmark-check-fill text-warning fs-2"></i>
            <h5 class="fw-bold mb-0">305</h5>
            <small class="text-muted fs-6">Verifikasi</small>
          </div>
          <div class="col-6 col-md-1 mb-3">
            <i class="bi bi-check2-square text-warning fs-2"></i>
            <h5 class="fw-bold mb-0">798</h5>
            <small class="text-muted fs-6">Penanganan Selesai</small>
          </div>
        </div>
      </div>            
    </div>
  </div>      
</section>

<!-- Kategori Laporan Section -->
<section id="kategori" class="min-vh-100 d-flex align-items-center position-relative overflow-hidden">
  <img src="{{ asset('assets/img/dashboard-3.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="z-index: 0;" data-aos="fade-in" />
  <div class="container position-relative" style="z-index: 1;">
    <div class="section-title text-md-start" data-aos="fade-up">
      <h2>KATEGORI LAPORAN</h2>
    </div>
    <div class="row justify-content-center gy-4">
      <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
        <div class="card-kategori text-center shadow">
          <i class="bi bi-search text-danger"></i>
          <h5><a href="#">Lacak Laporanmu &gt;</a></h5>
          <p>Sudah Melapor? Lacak menggunakan nomor laporan.</p>
        </div>
      </div>
      <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
        <div class="card-kategori text-center shadow">
          <i class="bi bi-graph-up text-purple"></i>
          <h5><a href="#">Laporan Masuk &amp; Selesai &gt;</a></h5>
          <p>Data Laporan Masuk Tahun 2025</p>
        </div>
      </div>
      <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
        <div class="card-kategori text-center shadow">
          <i class="bi bi-clipboard-data text-primary"></i>
          <h5><a href="#">Aktivitas Laporan &gt;</a></h5>
          <p>Lihat Aktivitas Laporanmu</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Peta Section -->
<section id="peta" class="peta section dark-background">
  <div class="background-overlay">
    <img src="{{ asset('assets/img/peta.png') }}" alt="Peta Indonesia" class="peta-img">
  </div>
  <div class="container">
    <div class="row justify-content-start">
      <div class="col-xl-6">
        <div class="text-block">
          <h2><span class="light-text">PETA</span><br><strong>KONDISI JALAN</strong></h2>
          <div class="underline"></div>
          <a class="cta-btn" href="#">Baca Lebih Lanjut &gt;</a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
