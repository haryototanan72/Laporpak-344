@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('dashboard') }}" class="text-decoration-none d-inline-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i>
                    <span class="fw-semibold" style="color: #fbb03b;">Kembali ke Dashboard</span>
                </a>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Profile Picture Section -->
                        <div class="col-md-4 text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                         alt="Profile Picture" 
                                         class="rounded-circle img-fluid mb-3"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/default-avatar.png') }}" 
                                         alt="Default Avatar" 
                                         class="rounded-circle img-fluid mb-3"
                                         style="width: 150px; height: 150px; object-fit: cover; background-color: #f8f9fa;">
                                @endif
                            </div>
                            @if(Auth::user() && Auth::user()->role == 'user')
                                <button class="btn btn-sm" 
                                        style="background-color: #fbb03b; color: white;"
                                        onclick="window.location.href='{{ route('profile.edit') }}'">
                                    Edit Profile
                                </button>
                            @endif
                        </div>

                        <!-- Profile Information Section -->
                        <div class="col-md-8">
                            <div class="profile-info">
                                <div class="info-group mb-3">
                                    <label class="text-muted mb-1">Nama Lengkap</label>
                                    <div class="form-control-plaintext" 
                                         style="background-color: #f8f9fa; padding: 8px 12px; border-radius: 6px;">
                                        {{ $user->name }}
                                    </div>
                                </div>

                                <div class="info-group mb-3">
                                    <label class="text-muted mb-1">Email</label>
                                    <div class="form-control-plaintext" 
                                         style="background-color: #f8f9fa; padding: 8px 12px; border-radius: 6px;">
                                        {{ $user->email }}
                                    </div>
                                </div>

                                <div class="info-group mb-3">
                                    <label class="text-muted mb-1">No. Telepon</label>
                                    <div class="form-control-plaintext" 
                                         style="background-color: #f8f9fa; padding: 8px 12px; border-radius: 6px;">
                                        {{ $user->phone_number ?? '-' }}
                                    </div>
                                </div>

                                <div class="info-group mb-3">
                                    <label class="text-muted mb-1">Jenis Kelamin</label>
                                    <div class="form-control-plaintext" 
                                         style="background-color: #f8f9fa; padding: 8px 12px; border-radius: 6px;">
                                        {{ $user->gender ?? '-' }}
                                    </div>
                                </div>

                                <div class="info-group mb-3">
                                    <label class="text-muted mb-1">Tanggal Lahir</label>
                                    <div class="form-control-plaintext" 
                                         style="background-color: #f8f9fa; padding: 8px 12px; border-radius: 6px;">
                                        {{ $user->birth_date ? $user->birth_date->format('d F Y') : '-' }}
                                    </div>
                                </div>

                                <div class="info-group mb-3">
                                    <label class="text-muted mb-1">Alamat</label>
                                    <div class="form-control-plaintext" 
                                         style="background-color: #f8f9fa; padding: 8px 12px; border-radius: 6px;">
                                        {{ $user->address ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    background: white;
    border-radius: 12px;
}

.profile-info label {
    font-size: 0.9rem;
    font-weight: 500;
}

.form-control-plaintext {
    transition: background-color 0.3s ease;
}

.form-control-plaintext:hover {
    background-color: #edf2f7 !important;
}

/* Back button hover effect */
a:hover .bi-arrow-left {
    transform: translateX(-3px);
    transition: transform 0.3s ease;
}

a:hover span {
    text-decoration: underline;
}
</style>
@endsection
