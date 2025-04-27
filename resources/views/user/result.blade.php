<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LACAK LAPORANMU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Logo Only Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-center py-4">
                <div class="text-xl font-bold">LaporPak!</div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto mt-8 px-4">
        <h1 class="text-3xl font-bold text-center mb-4">LACAK LAPORANMU</h1>
        <p class="text-center mb-8">Sudah bikin laporan belum? Kalau sudah, Masukkan Nomor Laporanmu dibawah ini!</p>

        <!-- Nomor Laporan Display -->
        <div class="flex flex-col items-center mb-10">
            <div class="w-full max-w-xl bg-white rounded-lg shadow p-4 flex items-center justify-between">
                <input type="text" class="flex-1 bg-transparent outline-none text-gray-700" value="{{ $report->nomor_laporan }}" readonly />

            </div>
        </div>

        <!-- Timeline -->
        <div class="w-full max-w-3xl mx-auto flex justify-center">
            <div class="flex items-start justify-between relative gap-x-8 w-full">
                <!-- Garis Horizontal -->
                <div class="absolute top-6 left-0 right-0 h-1 bg-gray-200 z-0"></div>
                @php
                    $steps = [
                        [
                            'label' => 'Tulis Laporan',
                            'icon' => 'fas fa-pencil-alt',
                            'color' => 'bg-yellow-400',
                            'active' => true,
                            'desc' => 'Laporkan keluhan atau aspirasi anda dengan jelas dan lengkap',
                        ],
                        [
                            'label' => 'Proses Verifikasi',
                            'icon' => 'fas fa-clipboard-check',
                            'color' => in_array($report->status, ['Diproses','Diterima','Ditolak','Ditindaklanjuti','Ditanggapi','Selesai']) ? 'bg-yellow-400' : 'bg-gray-300',
                            'active' => in_array($report->status, ['Diproses','Diterima','Ditolak', 'Ditindaklanjuti','Ditanggapi','Selesai']),
                            'desc' => 'Dalam 3 hari, laporan Anda akan diverifikasi dan diteruskan kepada instansi berwenang',
                        ],
                        [
                            'label' => ($report->status == 'Ditolak') ? 'Laporan Anda Ditolak' : 'Laporan Anda Disetujui',
                            'icon' => ($report->status == 'Ditolak') ? 'fas fa-times' : 'fas fa-check-circle',
                            'color' => ($report->status == 'Ditolak') ? 'bg-red-400' : (in_array($report->status, ['Diterima','Ditindaklanjuti','Ditanggapi','Selesai']) ? 'bg-yellow-400' : 'bg-gray-300'),
                            'active' => in_array($report->status, ['Diterima','Ditindaklanjuti','Ditanggapi','Selesai','Ditolak']),
                            'desc' => ($report->status == 'Ditolak') ? ($alasan_penolakan ?? 'Maaf, laporan anda kurang valid') : 'Silahkan tunggu proses selanjutnya',
                        ],
                        [
                            'label' => 'Proses Tindak lanjut',
                            'icon' => 'fas fa-cogs',
                            'color' => (in_array($report->status, ['Ditindaklanjuti','Ditanggapi','Selesai'])) ? 'bg-yellow-400' : 'bg-gray-300',
                            'active' => in_array($report->status, ['Ditindaklanjuti','Ditanggapi','Selesai']),
                            'desc' => 'Laporanmu berhasil diajukan silahkan tunggu progres pembangunan',
                        ],
                        [
                            'label' => 'Beri Tanggapan',
                            'icon' => 'fas fa-comments',
                            'color' => (in_array($report->status, ['Ditanggapi','Selesai'])) ? 'bg-yellow-400' : 'bg-gray-300',
                            'active' => in_array($report->status, ['Ditanggapi','Selesai']),
                            'desc' => '<span class="font-semibold">Anda dapat menanggapi umpan balik</span>',
                        ],
                        [
                            'label' => 'Selesai',
                            'icon' => 'fas fa-check',
                            'color' => ($report->status == 'Selesai') ? 'bg-green-500' : 'bg-gray-300',
                            'active' => $report->status == 'Selesai',
                            'desc' => 'Laporan Anda akan terus ditindaklanjuti hingga terselesaikan',
                        ],
                    ];
                @endphp
                @foreach($steps as $i => $step)
                    <div class="flex flex-col items-center z-10 flex-1">
                        <div class="flex flex-col items-center">
                            <div class="w-14 h-14 rounded-full flex items-center justify-center {{ $step['color'] }} {{ $step['active'] ? 'shadow-lg' : '' }} border-4 border-white text-white text-2xl mb-2">
                                <i class="{{ $step['icon'] }}"></i>
                            </div>
                            <div class="font-bold text-center text-base {{ $step['active'] ? 'text-yellow-500' : 'text-gray-400' }}">{!! $step['label'] !!}</div>
                        </div>
                        <div class="mt-2 text-xs text-center text-gray-500 max-w-[140px]">{!! $step['desc'] !!}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Detail Laporan -->
        <div class="bg-gray-50 rounded-lg p-6 mt-8 shadow-inner max-w-2xl mx-auto">
            <h3 class="font-bold text-yellow-600 mb-2 text-lg">Detail Laporan</h3>
            <div class="flex flex-wrap gap-4 mb-2">
                <span class="font-semibold">Tanggal Laporan:</span>
                <span>{{ $report->tanggal_laporan }}</span>
                <span class="font-semibold">Status Terakhir:</span>
                <span>{{ $report->status }}</span>
            </div>
            <div>
                <span class="font-semibold">Deskripsi:</span>
                <span>{{ $report->deskripsi }}</span>
            </div>
        </div>
        <!-- Back Button -->
        <div class="text-center mt-8">
            <a href="{{ route('lacak-laporan') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded inline-block">
                Kembali
            </a>
        </div>
    </div>
</body>
</html>
