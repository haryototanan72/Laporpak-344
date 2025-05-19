<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LaporPak! - Dashboard User</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>
<body class="index-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="{{ route('landing') }}" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">LaporPak!</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#" class="active">Dashboard</a></li>
          <li><a href="#statistik">Statistik</a></li>
          <li><a href="#kategori">Kategori</a></li>
          <li><a href="{{ route('laporan.index') }}">Laporan Saya</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      @auth
      @if(auth()->user()->role === 'user')
      <div class="position-absolute end-0 top-0 m-3" style="z-index:10;">
        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            @if(auth()->user()->profile_picture)
              <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
            @else
              <img src="{{ asset('assets/img/default-avatar.png') }}" alt="Profile" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
            @endif
            <span class="fw-semibold">{{ auth()->user()->name }}</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.index') }}"><i class="bi bi-person"></i> Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
      @endif
      @endauth
      <div class="ms-3">
        <span class="text-dark fw-bold"><i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}</span>
      </div>
    </div>
  </header>
  <main class="main">
    <!-- Hero Section mirip landing -->
    <section id="hero" class="min-vh-100 d-flex align-items-center position-relative overflow-hidden dark-background" style="z-index: 0; background: url('{{ asset('assets/img/hero-bg.jpg') }}') center center / cover no-repeat;">
      <img src="{{ asset('assets/img/dashboard-1.png') }}" alt="" class="landing-bg position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="z-index: 1; opacity: 1; pointer-events:none;">
      <div class="container position-relative z-2">
        <div class="row gy-4 d-flex justify-content-between">
          <div class="col-lg-8 d-flex flex-column justify-content-center text-white">
            <h1 class="fw-bold display-4 mb-2">LAYANAN PENGADUAN ONLINE</h1>
            <p class="fs-5 mb-3">Laporkan segera saat Anda mempunyai informasi Jalan atau Jembatan Nasional Rusak</p>
            <a href="{{ route('profile.form_laporan') }}" id="btn-lapor" class="btn btn-danger btn-lg px-4 py-2">LAPOR!</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Statistik Section mirip landing -->
    <section id="statistik" class="min-vh-100 d-flex align-items-center position-relative overflow-hidden" style="z-index: 0;">
      <img src="{{ asset('assets/img/dashboard-2.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="z-index: 0; opacity: 0.95;">
      <div class="container position-relative" style="z-index: 2;">
        <div class="row">
          <div class="col-lg-5 mb-4 mb-lg-0">
            <h2 class="fw-bold" style="font-size:2.5rem; color:#232b44;">
              <span style="border-bottom:4px solid #ffb300; display:inline-block; margin-bottom:10px;">Statistik</span><br>LaporPak
            </h2>
          </div>
          <div class="col-lg-7">
            <div class="d-flex flex-row flex-wrap justify-content-lg-start justify-content-center align-items-end gap-4">
              <div class="stat-card text-center bg-white bg-opacity-75 shadow-sm p-3 rounded" style="width:140px; height:170px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                <i class="bi bi-file-earmark-text-fill" style="font-size:2.1rem; color:#ffb300; margin-bottom:10px;"></i>
                <div class="fw-bold" style="font-size:1.7rem; color:#232b44; line-height:1;">{{ $total ?? '0' }}</div>
                <div class="small mt-1" style="color:#232b44;">Total</div>
              </div>
              <div class="stat-card text-center bg-white bg-opacity-75 shadow-sm p-3 rounded" style="width:140px; height:170px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                <i class="bi bi-calendar-check" style="font-size:2.1rem; color:#ffb300; margin-bottom:10px;"></i>
                <div class="fw-bold" style="font-size:1.7rem; color:#232b44; line-height:1;">{{ $baru ?? '0' }}</div>
                <div class="small mt-1" style="color:#232b44;">Baru</div>
              </div>
              <div class="stat-card text-center bg-white bg-opacity-75 shadow-sm p-3 rounded" style="width:140px; height:170px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                <i class="bi bi-check2-square" style="font-size:2.1rem; color:#ffb300; margin-bottom:10px;"></i>
                <div class="fw-bold" style="font-size:1.7rem; color:#232b44; line-height:1;">{{ $selesai ?? '0' }}</div>
                <div class="small mt-1" style="color:#232b44;">Selesai</div>
              </div>
              <div class="stat-card text-center bg-white bg-opacity-75 shadow-sm p-3 rounded" style="width:140px; height:170px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                <i class="bi bi-gear-fill" style="font-size:2.1rem; color:#ffb300; margin-bottom:10px;"></i>
                <div class="fw-bold" style="font-size:1.7rem; color:#232b44; line-height:1;">{{ $proses ?? '0' }}</div>
                <div class="small mt-1" style="color:#232b44;">Proses</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Peta Section mirip landing -->
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
    <!-- Kategori Laporan Section mirip landing -->
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
              <h5><a href="{{ route('track.show') }}">Lacak Laporanmu &gt;</a></h5>
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
              <h5><a href="{{ route('laporan.index') }}">Aktivitas Laporan &gt;</a></h5>
              <p>Lihat Aktivitas Laporanmu</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Video Section mirip landing -->
    <section id="about" class="video" style="background-image: url('{{ asset('assets/img/video1.png') }}'); background-size: cover; background-position: center;">
      <div class="container">
        <div class="row gy-4">
          <!-- Gambar + Play Button -->
          <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
            <img src="{{ asset('assets/img/video2.png') }}" class="img-fluid rounded" alt="">
            <a href="https://www.youtube.com/watch?v=cd940jePm3Y" class="glightbox pulsating-play-btn"></a>
          </div>
          <!-- Konten Teks -->
          <div class="col-lg-6 content order-last order-lg-first text-white d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <h3>Konten Sosialisasi LaporPak</h3>
            <p>
              Kegiatan Sosialisasi secara offline oleh <br>
              sepeda motor di wilayah Kota Bandung<br>
              pada tanggal 3 Januari 2024
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- Recent Posts Section mirip landing -->
    <section id="recent-posts" class="py-5" style="background:#fff;">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3 class="fw-bold" style="color:#232b44;">Recent Posts</h3>
          <a href="#" class="btn btn-outline-secondary btn-sm fw-bold">VIEW ALL <i class="bi bi-arrow-up-right"></i></a>
        </div>
        <div class="row">
          <!-- Main Posts -->
          <div class="col-lg-8">
            <div class="row g-3">
              @foreach(($recentPosts ?? []) as $laporan)
                <div class="col-md-4">
                  <div class="card bg-dark text-white h-100">
                    <img src="{{ asset('assets/img/news1.jpg') }}" class="card-img" alt="">
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-2">
                      <h6 class="card-title fw-bold mb-1" style="font-size:1rem;">{{ $laporan->judul ?? '-' }}</h6>
                      <p class="card-text mb-0" style="font-size:0.85rem;"><i class="bi bi-calendar"></i> {{ $laporan->created_at ? $laporan->created_at->format('d M Y') : '-' }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
              @if(empty($recentPosts) || count($recentPosts) < 3)
                @for($i = (count($recentPosts ?? [])); $i < 3; $i++)
                <div class="col-md-4">
                  <div class="card bg-dark text-white h-100">
                    <img src="{{ asset('assets/img/news'.($i+1).'.jpg') }}" class="card-img" alt="">
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-2">
                      <h6 class="card-title fw-bold mb-1" style="font-size:1rem;">Lorem Ipsum Is Simply Dummy Text</h6>
                      <p class="card-text mb-0" style="font-size:0.85rem;"><i class="bi bi-calendar"></i> 27 August, 2024</p>
                    </div>
                  </div>
                </div>
                @endfor
              @endif
            </div>
            <div class="row g-3 mt-2">
              @for($i = 0; $i < 2; $i++)
              <div class="col-md-6">
                <div class="card bg-dark text-white h-100">
                  <img src="{{ asset('assets/img/news'.($i+4).'.jpg') }}" class="card-img" alt="">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-2">
                    <h6 class="card-title fw-bold mb-1" style="font-size:1rem;">Lorem Ipsum Is Simply Dummy Text Of The Printing</h6>
                    <p class="card-text mb-0" style="font-size:0.85rem;"><i class="bi bi-calendar"></i> 27 August, 2024 <i class="bi bi-clock ms-2"></i> 20 mins</p>
                  </div>
                </div>
              </div>
              @endfor
            </div>
          </div>
          <!-- Sidebar News List -->
          <div class="col-lg-4">
            <div class="d-flex justify-content-between mb-2">
              <span class="badge bg-danger fw-bold">Latest News</span>
              <button class="btn btn-light btn-sm fw-bold">Featured</button>
            </div>
            @for($i = 0; $i < 4; $i++)
            <div class="d-flex mb-3 align-items-center">
              <img src="{{ asset('assets/img/news'.($i+6).'.jpg') }}" width="80" height="60" class="me-2 object-fit-cover rounded" alt="">
              <div>
                <p class="mb-1 small fw-bold" style="color:#232b44;">Lorem Ipsum Is Simply Dummy Text</p>
                <small class="text-muted"><i class="bi bi-calendar"></i> 27 August, 2024</small>
              </div>
            </div>
            @endfor
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="custom-footer py-4 bg-dark text-white">
    <div class="container footer-content d-flex flex-wrap justify-content-between align-items-center">
      <div class="footer-section social-icons mb-2">
        <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
        <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
        <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
      </div>
      <div class="footer-section contact-info mb-2">
        <span class="me-3"><i class="bi bi-envelope"></i> laporpak@laporpak.com</span>
        <span class="me-3"><i class="bi bi-telephone"></i> (022) 555-0103</span>
        <span><i class="bi bi-geo-alt"></i> Jl. Telekomunikasi No.1, Bandung</span>
      </div>
      <div class="footer-section copyright mb-2">
        &copy; 2024 LaporPak! All rights reserved.
      </div>
    </div>
  </footer>
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
