@extends('layouts.adminlayout')
@section('content')
<div class="container-fluid">
    <h2 class="mb-4 fw-bold">Pengguna</h2>
    <div class="mb-4">
        <div class="stat-box"><div class="stat-icon"><i class="bi bi-clipboard-data"></i></div><div class="stat-value">{{ $users->count() }}</div><div class="stat-label">Jumlah Pengguna</div></div>
        <div class="stat-box"><div class="stat-icon"><i class="bi bi-person-check"></i></div><div class="stat-value">{{ $users->where('status','aktif')->count() }}</div><div class="stat-label">Aktif</div></div>
        <div class="stat-box"><div class="stat-icon"><i class="bi bi-person-x"></i></div><div class="stat-value">{{ $users->where('status','tidak aktif')->count() }}</div><div class="stat-label">Tidak Aktif</div></div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $i => $user)
                <tr>
                    <td>{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <span class="badge {{ $user->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>
                    <td>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.user.updateStatus', $user->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $user->status == 'aktif' ? 'btn-danger' : 'btn-success' }}">
                                {{ $user->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

