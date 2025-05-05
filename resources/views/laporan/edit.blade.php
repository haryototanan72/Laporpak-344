<!DOCTYPE html>
<html>
<head>
    <title>Form Laporan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Leaflet CSS untuk OpenStreetMap -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- jQuery UI CSS untuk Autocomplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <!-- JANGAN load JS di sini, load SEMUA JS DI PALING BAWAH sebelum </body> -->
    <style>
        /* Pastikan dropdown autocomplete selalu di depan map */
        .ui-autocomplete {
            z-index: 99999 !important;
            position: absolute !important;
            background: #fff;
            border: 1px solid #ddd;
        }
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(135deg, #e0ecfc 0%, #f9f6e7 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 480px;
            margin: 40px auto;
            background: #fff;
            padding: 32px 24px 28px 24px;
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            position: relative;
        }

        .title {
            font-size: 2.1rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
            color: #222;
        }
        .subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 2.2rem;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 4px;
        }
        .form-control, select {
            border-radius: 8px;
            border: 1.5px solid #e0e0e0;
            font-size: 1rem;
            padding: 10px 14px;
            margin-bottom: 2px;
        }
        .form-control:focus, select:focus {
            border-color: #f6b23e;
            box-shadow: 0 0 0 2px #ffe4b8;
        }
        .form-control {
            white-space: pre-wrap;
            overflow-wrap: break-word;
            min-height: 38px;
        }
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        .form-check-label {
            font-size: 0.97rem;
            color: #444;
        }
        .form-check-input:checked {
            background-color: #f6b23e;
            border-color: #f6b23e;
        }
        .error-message {
            color: #e74c3c;
            font-size: 0.95rem;
            margin-top: 2px;
        }
        .required {
            color: #e74c3c;
            margin-left: 2px;
        }
        .optional {
            color: #aaa;
            font-style: italic;
        }
        .btn-lapor {
            background: linear-gradient(90deg, #ff8c42 0%, #ff3c3c 100%);
            color: #fff;
            font-size: 1.35rem;
            font-weight: 700;
            border: none;
            border-radius: 32px;
            box-shadow: 0 4px 18px 0 rgba(255, 140, 66, 0.15);
            padding: 12px 48px 12px 48px;
            margin: 0 auto 24px auto;
            display: block;
            transition: background 0.2s, box-shadow 0.2s;
            position: relative;
        }
        .btn-lapor:hover, .btn-lapor:focus {
            background: linear-gradient(90deg, #ff3c3c 0%, #ff8c42 100%);
            box-shadow: 0 8px 32px 0 rgba(255, 140, 66, 0.18);
        }
        .btn-cancel {
            background: #fff;
            color: #ff8c42;
            border: 2px solid #ff8c42;
            border-radius: 8px;
            font-weight: 500;
            margin-right: 10px;
            transition: background 0.2s, color 0.2s;
        }
        .btn-cancel:hover {
            background: #ffe4b8;
            color: #d35400;
        }
        .btn-submit {
            background: #f6b23e;
            color: #fff;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            transition: background 0.2s;
        }
        .btn-submit:hover {
            background: #e6a23c;
        }
        .alert-success, .alert-danger {
            font-size: 1rem;
            text-align: center;
            border-radius: 8px;
        }
        #map {
            height: 180px;
            width: 100%;
            margin-bottom: 16px;
            border-radius: 8px;
            border: 1.5px solid #e0e0e0;
            overflow: hidden;
        }
        #map iframe {
            width: 100%;
            height: 100%;
            border: 0;
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
        .edit-header-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #333;
            font-size: 1.8rem;
            margin: 0;
        }
        select.form-control {
            max-width: 100%;
            white-space: normal;
            text-overflow: ellipsis;
            overflow: visible;
        }
        select.form-control option {
            white-space: normal;
            word-wrap: break-word;
            max-width: 100vw;
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-back" title="Kembali">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </a>
            <h1 class="edit-header-title">Edit Laporan</h1>
            <div></div>
        </div>

        @if(session('nomor_laporan'))
            <div class="alert alert-success">
                Laporan berhasil dikirim! Nomor Laporan Anda adalah: <span class="font-weight-bold">{{ session('nomor_laporan') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
        <form id="laporanForm" action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data" style="margin-top:10px;" autocomplete="off" novalidate>
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="jenis_laporan">Jenis Laporan <span class="required">*</span></label>
                <select class="form-control" id="jenis_laporan" name="jenis_laporan" required>
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="Privat/Rahasia" {{ $laporan->jenis_laporan == 'Privat/Rahasia' ? 'selected' : '' }}>Privat/Rahasia</option>
                    <option value="Publik" {{ $laporan->jenis_laporan == 'Publik' ? 'selected' : '' }}>Publik</option>
                </select>
                <div id="jenis_laporan_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="bukti_laporan">Bukti Laporan <span class="required">*</span></label>
                <input type="file" class="form-control" id="bukti_laporan" name="bukti_laporan" accept="image/*,video/*" required>
                <div class="error-message" id="bukti_laporan_error"></div>
                <div id="file-link-container" class="mt-2"></div>

                <script>
                    // Fungsi untuk menampilkan link file
                    function updateFileLink(input) {
                        const container = document.getElementById('file-link-container');
                        const file = input.files[0];
                        
                        if (file) {
                            container.innerHTML = '';
                            const link = document.createElement('a');
                            link.href = URL.createObjectURL(file);
                            link.target = '_blank';
                            link.className = 'text-primary';
                            link.innerHTML = '<i class="fa fa-file me-1"></i>Bukti Laporan';
                            container.appendChild(link);
                        } else {
                            container.innerHTML = '';
                        }
                    }

                    // Inisialisasi link untuk file yang sudah ada
                    document.addEventListener('DOMContentLoaded', function() {
                        const input = document.getElementById('bukti_laporan');
                        if (input) {
                            input.addEventListener('change', function() {
                                updateFileLink(this);
                            });
                        }

                        @if($laporan->bukti_laporan)
                            const container = document.getElementById('file-link-container');
                            const link = document.createElement('a');
                            link.href = '{{ asset('storage/'.$laporan->bukti_laporan) }}';
                            link.target = '_blank';
                            link.className = 'text-primary';
                            link.innerHTML = '<i class="fa fa-file me-1"></i>Bukti Laporan';
                            container.appendChild(link);
                        @endif
                    });
                </script>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi Laporan <span class="required">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Ketik disini" value="{{ $laporan->lokasi }}" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" id="btn-lokasi-saya" title="Dapatkan Lokasi Saya">
                            <span class="d-none d-md-inline">Lokasi Saya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                              <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div id="lokasi_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <div id="map" style="height: 200px;"></div>
                <div id="maps_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="ciri_khusus">Ciri Khusus</label>
                <textarea class="form-control" id="ciri_khusus" name="ciri_khusus" rows="3">{{ $laporan->ciri_khusus }}</textarea>
                <div id="ciri_khusus_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori <span class="required">*</span></label>
                <select class="form-control" id="kategori" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Jalan Rusak" {{ $laporan->kategori == 'Jalan Rusak' ? 'selected' : '' }}>Jalan Rusak</option>
                    <option value="Jembatan Rusak" {{ $laporan->kategori == 'Jembatan Rusak' ? 'selected' : '' }}>Jembatan Rusak</option>
                    <option value="Banjir" {{ $laporan->kategori == 'Banjir' ? 'selected' : '' }}>Banjir</option>
                </select>
                <div id="kategori_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi <span class="required">*</span></label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $laporan->deskripsi }}</textarea>
                <div id="deskripsi_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <a href="{{ route('laporan.index') }}" class="btn btn-cancel">Cancel</a>
                <button type="submit" class="btn btn-submit">Update</button>
            </div>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Inisialisasi map

            // Inisialisasi map
            let map, marker;
            
            $(document).ready(function() {
                // Inisialisasi map
                map = L.map('map').setView([-6.9032739, 107.5731165], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: ' OpenStreetMap contributors'
                }).addTo(map);
                marker = L.marker([-6.9032739, 107.5731165], {draggable: true}).addTo(map);

                // Set value field dari data laporan
                const laporanData = @json($laporan);
                $('#jenis_laporan').val(laporanData.jenis_laporan);
                $('#lokasi').val(laporanData.lokasi);
                $('#kategori').val(laporanData.kategori);
                $('#deskripsi').val(laporanData.deskripsi);

                // Inisialisasi awal marker berdasarkan data yang ada
                var initialLocation = $('#lokasi').val();
                if (initialLocation) {
                    var coordMatch = initialLocation.match(/^(-?\d+\.\d+),\s*(-?\d+\.\d+)$/);
                    if (coordMatch) {
                        var lat = parseFloat(coordMatch[1]);
                        var lng = parseFloat(coordMatch[2]);
                        var latlng = { lat: lat, lng: lng };
                        map.setCenter(latlng);
                        marker.setLatLng(latlng);
                    }
                }

                // Fungsi untuk tombol Lokasi Saya
                $('#btn-lokasi-saya').on('click', function() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var latlng = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            map.setView(latlng, 16);
                            marker.setLatLng(latlng);
                            $('#lokasi').val(latlng.lat + ', ' + latlng.lng);
                            
                            // Reverse geocoding ke alamat
                            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latlng.lat}&lon=${latlng.lng}`)
                                .then(res => res.json())
                                .then(data => {
                                    if (data.display_name) {
                                        $('#lokasi').val(data.display_name);
                                    }
                                });
                        }, function(error) {
                            console.error('Error getting location:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Tidak dapat mendapatkan lokasi Anda. Pastikan GPS Anda aktif.',
                                confirmButtonText: 'OK'
                            });
                        });
                    } else {
                        console.error('Geolocation is not supported by this browser.');
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Geolocation tidak didukung oleh browser Anda.',
                            confirmButtonText: 'OK'
                        });
                    }
                });

                // Autocomplete lokasi dengan jQuery UI + Nominatim
                $('#lokasi').autocomplete({
                    minLength: 2,
                    source: function(request, response) {
                        $.ajax({
                            url: 'https://nominatim.openstreetmap.org/search',
                            data: { 
                                q: request.term, 
                                format: 'json', 
                                limit: 5 
                            },
                            success: function(data) {
                                response($.map(data, function(item) {
                                    return {
                                        label: item.display_name,
                                        value: item.display_name,
                                        lat: item.lat,
                                        lon: item.lon
                                    };
                                }));
                            }
                        });
                    },
                    select: function(event, ui) {
                        var latlng = {
                            lat: parseFloat(ui.item.lat),
                            lng: parseFloat(ui.item.lon)
                        };
                        map.setView(latlng, 16);
                        marker.setLatLng(latlng);
                    }
                });

                // Jika field lokasi diisi manual koordinat
                $('#lokasi').on('change', function() {
                    var val = $(this).val();
                    var coordMatch = val.match(/^(-?\d+\.\d+),\s*(-?\d+\.\d+)$/);
                    if (coordMatch) {
                        var lat = parseFloat(coordMatch[1]);
                        var lng = parseFloat(coordMatch[2]);
                        var latlng = [lat, lng];
                        marker.setLatLng(latlng);
                        map.setView(latlng, 16);
                        
                        // Reverse geocoding ke alamat
                        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.display_name) {
                                    $('#lokasi').val(data.display_name);
                                }
                            });
                    }
                });

                // Event handler untuk drag marker
                marker.on('dragend', function(event) {
                    var position = marker.getLatLng();
                    $('#lokasi').val(position.lat + ', ' + position.lng);
                });

                // Preview gambar bukti laporan
                $('#bukti_laporan').on('change', function(e) {
                    var file = e.target.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#preview-bukti').attr('src', e.target.result).show();
                        }
                        reader.readAsDataURL(file);
                    }
                });

                // Validasi form
                $('#laporanForm').on('submit', function(e) {
                    // Reset error messages
                    $('.error-message').empty();
                    
                    // Validasi required fields
                    let isValid = true;
                    
                    if ($('#jenis_laporan').val() === '') {
                        $('#jenis_laporan_error').text('Jenis laporan harus dipilih');
                        isValid = false;
                    }
                    
                    if ($('#lokasi').val().trim() === '') {
                        $('#lokasi_error').text('Lokasi harus diisi');
                        isValid = false;
                    }
                    
                    if ($('#kategori').val() === '') {
                        $('#kategori_error').text('Kategori harus dipilih');
                        isValid = false;
                    }
                    
                    if ($('#deskripsi').val().trim() === '') {
                        $('#deskripsi_error').text('Deskripsi harus diisi');
                        isValid = false;
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Lengkapi Kolom yang Kosong',
                            text: 'Ada beberapa kolom yang masih kosong. Silakan lengkapi semua kolom yang diperlukan.',
                            confirmButtonText: 'OK'
                        });
                        return false;
                    }

                    // Submit form secara normal
                    this.submit();
                });
            });
        </script>

    </div>
</body>
</html>