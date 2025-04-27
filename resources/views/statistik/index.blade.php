<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Statistik - LaporPak</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">
  <!-- Header -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="{{ route('landing') }}" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">LaporPak!</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('landing') }}">Beranda</a></li>
          <li><a href="{{ route('track.show') }}">Lacak Laporan</a></li>
          <li><a href="{{ route('laporan.masuk') }}">Laporan Masuk</a></li>
          <li><a href="{{ route('statistik') }}" class="active">Statistik</a></li>
          <li><a href="#about">Tentang</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main id="main">
    <!-- Statistik Section -->
    <section class="statistik section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h4 class="mb-4">Statistik Laporan</h4>
            
            <!-- Overview Cards -->
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="card border-0 shadow-sm mb-3">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-shrink-0 me-3">
                        <div class="rounded-circle p-3" style="background-color: #e0f2fe;">
                          <i class="bi bi-file-text text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                      </div>
                      <div>
                        <h6 class="mb-1">Total Laporan</h6>
                        <h4 class="mb-0">{{ $totalLaporan }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card border-0 shadow-sm mb-3">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-shrink-0 me-3">
                        <div class="rounded-circle p-3" style="background-color: #fef3c7;">
                          <i class="bi bi-calendar3 text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                      </div>
                      <div>
                        <h6 class="mb-1">Laporan Bulan Ini</h6>
                        <h4 class="mb-0">{{ $laporanBulanIni }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Status Laporan -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">
                <h5 class="card-title mb-4">Status Laporan</h5>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>Persentase</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($statusLaporan as $status)
                      <tr>
                        <td>
                          @if($status->status == 'Menunggu')
                            <span class="badge bg-warning">{{ $status->status }}</span>
                          @elseif($status->status == 'Selesai')
                            <span class="badge bg-success">{{ $status->status }}</span>
                          @else
                            <span class="badge bg-danger">{{ $status->status }}</span>
                          @endif
                        </td>
                        <td>{{ $status->total }}</td>
                        <td>{{ number_format(($status->total / $totalLaporan) * 100, 1) }}%</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Kategori Laporan -->
            <div class="card border-0 shadow-sm">
              <div class="card-body">
                <h5 class="card-title mb-4">Kategori Laporan</h5>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Persentase</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($kategoriLaporan as $kategori)
                      <tr>
                        <td>{{ $kategori->kategori }}</td>
                        <td>{{ $kategori->total }}</td>
                        <td>{{ number_format(($kategori->total / $totalLaporan) * 100, 1) }}%</td>
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
    </section>
  </main>

  <!-- Footer -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>LaporPak!</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <style>
    .section-padding {
      padding-top: 120px;
      padding-bottom: 80px;
    }

    .header {
      background: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }

    .sitename {
      color: #fbb03b;
      font-weight: bold;
      font-size: 1.5rem;
      margin: 0;
    }

    .navmenu ul {
      margin: 0;
      padding: 0;
      list-style: none;
      display: flex;
      align-items: center;
      gap: 2rem;
    }

    .navmenu a {
      color: #4b5563;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .navmenu a:hover,
    .navmenu a.active {
      color: #fbb03b;
    }

    .card {
      border-radius: 12px;
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: translateY(-2px);
    }

    .badge {
      font-weight: 500;
      padding: 0.5em 0.75em;
    }

    .table > :not(caption) > * > * {
      padding: 1rem;
    }
  </style>
</body>
</html>
