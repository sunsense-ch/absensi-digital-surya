<x-app-layout>
    <x-slot name="header"><h2>Dashboard Siswa</h2></x-slot>

    <div class="card" style="max-width:480px;">
        <p style="font-size:15px;font-weight:600;color:var(--primary-dark);margin:0 0 4px;">
            Halo, {{ auth()->user()->name }}
        </p>
        <p style="font-size:12.5px;color:var(--muted);margin:0 0 16px;">
            Selamat datang di Aplikasi Absensi Digital.
        </p>
        <a href="{{ route('siswa.scan') }}" class="btn btn-primary" style="display:inline-block;text-decoration:none;">
            Scan QR Absensi
        </a>
    </div>
</x-app-layout>
