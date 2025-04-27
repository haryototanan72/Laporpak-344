<!-- Form pelacakan laporan -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lacak Laporan</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-2xl mx-auto">
    <h1 class="text-3xl font-extrabold mb-2 text-center text-yellow-500 tracking-wide uppercase">LACAK LAPORANMU</h1>
    <p class="text-center mb-6 text-gray-600">Sudah bikin laporan belum? Kalau sudah, Masukkan Nomor Laporanmu dibawah ini!</p>
    @if(session('error'))
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        {{ session('error') }}
      </div>
    @endif
    <form action="{{ route('report.search') }}" method="POST" class="mb-10">
      @csrf
      <label class="block mb-2 font-semibold" for="nomor_laporan">Nomor Laporan:</label>
      <input type="text" name="nomor_laporan" id="nomor_laporan" required
             class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-yellow-400">
      <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded font-bold">
        Cari
      </button>
    </form>
    @isset($laporan)
    <div class="text-center mb-6">
      <span class="block text-lg font-bold text-yellow-500">Nomor Laporan:</span>
      <span class="block text-2xl font-bold text-yellow-600 tracking-widest mb-2">{{ $laporan->nomor_laporan }}</span>
    </div>
    <!-- Timeline tahapan -->
    <div class="flex justify-center mb-8">
      <div class="relative w-full max-w-md">
        @php
          $steps = [
            ['label' => 'Tulis Laporan', 'desc' => 'Laporkan keluhan atau aspirasi Anda dengan jelas dan lengkap'],
            ['label' => 'Proses Verifikasi', 'desc' => 'Dalam 7 hari laporan Anda akan diverifikasi dan ditindaklanjuti'],
            ['label' => 'Laporan Diterima', 'desc' => 'Laporan Anda telah diverifikasi dan diterima'],
            ['label' => 'Proses Tindak Lanjut', 'desc' => 'Laporan sedang dalam proses perbaikan'],
            ['label' => 'Beri Tanggapan', 'desc' => 'Anda dapat menanggapi tindak lanjut'],
            ['label' => 'Selesai', 'desc' => 'Laporan Anda telah selesai ditindaklanjuti'],
          ];
          $statusMap = [
            'tulis' => 0,
            'verifikasi' => 1,
            'diterima' => 2,
            'proses' => 3,
            'tanggapan' => 4,
            'selesai' => 5,
          ];
          $currentStep = $statusMap[$laporan->status] ?? 0;
        @endphp
        <div class="flex flex-col items-center w-full">
          @foreach($steps as $i => $step)
            <div class="flex items-center w-full mb-2">
              <div class="flex flex-col items-center" style="min-width:48px;">
                <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $i <= $currentStep ? 'bg-yellow-400 text-white' : 'bg-gray-200 text-yellow-400' }} font-bold border-2 border-yellow-400">
                  @if($i < $currentStep)
                    <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M5 13l4 4L19 7' /></svg>
                  @elseif($i == $currentStep)
                    <span class="">{{ $i+1 }}</span>
                  @else
                    <span class="">{{ $i+1 }}</span>
                  @endif
                </div>
                @if($i < count($steps)-1)
                  <div class="h-8 w-1 {{ $i < $currentStep ? 'bg-yellow-400' : 'bg-gray-300' }}"></div>
                @endif
              </div>
              <div class="ml-4 text-left">
                <div class="font-bold text-lg {{ $i == $currentStep ? 'text-yellow-500' : ($i < $currentStep ? 'text-yellow-400' : 'text-gray-400') }}">{{ $step['label'] }}</div>
                <div class="text-gray-500 text-sm">{{ $step['desc'] }}</div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <!-- Detail laporan -->
    <div class="bg-gray-50 rounded-lg p-6 mt-2 shadow-inner">
      <h3 class="font-bold text-yellow-600 mb-2 text-lg">Detail Laporan</h3>
      <div class="flex flex-wrap gap-4 mb-2">
        <span class="font-semibold">Tanggal Laporan:</span>
        <span>{{ $laporan->tanggal_laporan }}</span>
        <span class="font-semibold">Status Terakhir:</span>
        <span>{{ $laporan->status_text }}</span>
      </div>
      <div>
        <span class="font-semibold">Deskripsi:</span>
        <span>{{ $laporan->deskripsi }}</span>
      </div>
    </div>
    <div class="text-center mt-6">
      <a href="{{ url()->previous() }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded shadow">Kembali</a>
    </div>
    @endisset
  </div>

</body>
</html>
