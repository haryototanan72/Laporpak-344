@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, Admin!</p>
</div>
@endsection
<a href="{{ route('admin.laporan.index') }}" 
   style="padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
    Manajemen Laporan
</a>
