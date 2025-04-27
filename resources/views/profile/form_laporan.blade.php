<!DOCTYPE html>
<html>
<head>
    <title>Form Laporan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
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
        textarea.form-control {
            min-height: 90px;
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
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn-back" title="Kembali">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6" />
            </svg>
        </a>
        <button type="button" class="btn-lapor" style="cursor:pointer;">LAPOR</button>
        <h1 class="title">LAYANAN PENGADUAN ONLINE</h1>
        <p class="subtitle">Laporkan segera saat Anda mempunyai informasi Jalan atau Jembatan Nasional Rusak</p>

        @if(session('nomor_laporan'))
            <div class="alert alert-success">
                Laporan berhasil dikirim! Nomor Laporan Anda adalah: <span class="font-weight-bold">{{ session('nomor_laporan') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form id="laporanForm" enctype="multipart/form-data" style="margin-top:10px;">
            @csrf
            <div class="form-group">
                <label for="kategori_laporan">Jenis Laporan <span class="required">*</span></label>
                <select class="form-control" id="jenis_laporan" name="jenis_laporan" required>
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="Privat">Privat/Rahasia</option>
                    <option value="Publik">Publik</option>
                </select>
                <div id="jenis_laporan_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="bukti_laporan">Bukti Laporan <span class="required">*</span></label>
                <input type="file" class="form-control" id="bukti_laporan" name="bukti_laporan" accept=".jpg,.jpeg,.png,.mp4" required>
                <div id="bukti_laporan_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="lokasi_laporan">Lokasi Laporan <span class="required">*</span></label>
                <input type="text" class="form-control" id="lokasi_laporan" name="lokasi_laporan" placeholder="Ketik disini" required>
                <div id="lokasi_laporan_error" class="error-message"></div>
                <div id="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.6091242787!2d107.57311654129782!3d-6.903273917028756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1645521234567!5m2!1sid!2sid" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="form-group">
                <label for="ciri_khusus_lokasi">Ciri Khusus Lokasi <span class="optional">(Optional)</span></label>
                <input type="text" class="form-control" id="ciri_khusus_lokasi" name="ciri_khusus_lokasi">
            </div>

            <div class="form-group">
                <label for="kategori_laporan">Kategori Laporan <span class="required">*</span></label>
                <select class="form-control" id="kategori_laporan" name="kategori_laporan" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Jalan Rusak">Jalan Rusak</option>
                    <option value="Jembatan Rusak">Jembatan Rusak</option>
                    <option value="Banjir">Banjir</option>
                </select>
                <div id="kategori_laporan_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="deskripsi_laporan">Deskripsi Laporan <span class="required">*</span></label>
                <textarea class="form-control" id="deskripsi_laporan" name="deskripsi_laporan" rows="3" required></textarea>
                <div id="deskripsi_laporan_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="ceklis" name="ceklis" required>
                    <label class="form-check-label" for="ceklis">
                        Laporan yang Saya Buat Benar dan dapat dipertanggungjawabkan <span class="required">*</span>
                    </label>
                </div>
                <div id="pernyataan_error" class="error-message"></div>
            </div>

            <button type="button" class="btn btn-cancel">Cancel</button>
            <button type="submit" class="btn btn-submit">Kirim</button>
        </form>

        <div id="successMessage" class="alert alert-success" style="display:none;">
            Laporan berhasil dikirim! Nomor Laporan Anda adalah: <span id="nomorLaporan"></span>
        </div>
        <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#laporanForm').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('submit.laporan') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#successMessage').show();
                        $('#nomorLaporan').text(response.nomor_laporan);
                        $('#errorMessage').hide();

                        // Reset form fields
                        $('#laporanForm')[0].reset();
                        // Clear error messages
                        $('.error-message').text('');
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = '';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else {
                            errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                        }
                        $('#errorMessage').text(errorMessage);
                        $('#errorMessage').show();
                        $('#successMessage').hide();

                        // Tampilkan pesan error dari validasi
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + '_error').text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>