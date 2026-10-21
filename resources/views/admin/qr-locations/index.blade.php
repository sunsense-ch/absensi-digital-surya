<x-app-layout>
    <x-slot name="header">
        <h2>Lokasi QR</h2>
    </x-slot>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <div class="card" style="margin-bottom:16px;">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
            <div>
                <p class="section-title" style="margin-bottom:2px;">Token QR Harian</p>
                <p style="font-size:12.5px;color:var(--muted);margin:0;">
                    Buat token baru untuk semua lokasi aktif. Lokasi yang sudah punya token hari ini akan dilewati otomatis.
                </p>
            </div>
            <form method="POST" action="{{ route('admin.qr-tokens.generate') }}">
                @csrf
                <button type="submit" class="btn btn-primary">Generate QR Hari Ini</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="toolbar">
            <p style="font-size:12.5px;color:var(--muted);margin:0;">{{ $qrLocations->total() }} lokasi terdaftar</p>
            <a href="{{ route('admin.qr-locations.create') }}" class="btn btn-primary">+ Tambah Lokasi</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kode</th>
                    <th>Koordinat</th>
                    <th>Radius</th>
                    <th>Status</th>
                    <th>Token Hari Ini</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($qrLocations as $location)
                    @php
                        // date di-cast jadi Carbon oleh model QrToken, jadi harus dibandingkan
                        // sebagai string tanggal, bukan langsung firstWhere('date', ...)
                        $todayToken = $location->tokens->first(
                            fn($t) => $t->date->format('Y-m-d') === today()->toDateString()
                        );
                    @endphp
                    <tr>
                        <td style="font-weight:600;color:var(--primary-dark);">{{ $location->name }}</td>
                        <td>{{ $location->code }}</td>
                        <td>{{ $location->latitude }}, {{ $location->longitude }}</td>
                        <td>{{ $location->radius }} m</td>
                        <td>
                            @if($location->is_active)
                                <span class="badge ok">Aktif</span>
                            @else
                                <span class="badge danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            @if($todayToken)
                                @if($todayToken->is_active && now()->lessThanOrEqualTo($todayToken->valid_until))
                                    <a href="{{ route('admin.qr-tokens.display', $todayToken) }}" class="badge ok">Lihat QR</a>
                                @else
                                    <span class="badge danger">Kedaluwarsa</span>
                                @endif
                            @else
                                <span class="badge warn">Belum ada</span>
                            @endif
                        </td>
                        <td style="text-align:right;">
                            <a href="{{ route('admin.qr-locations.edit', $location) }}" class="icon-btn">Edit</a>
                            <form action="{{ route('admin.qr-locations.destroy', $location) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn" style="color:var(--danger);"
                                    onclick="return confirm('Hapus lokasi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                Belum ada lokasi QR yang ditambahkan.
                                <a href="{{ route('admin.qr-locations.create') }}">Tambahkan lokasi pertama</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($qrLocations->hasPages())
            <div style="margin-top:14px;">{{ $qrLocations->links() }}</div>
        @endif
    </div>
</x-app-layout>
