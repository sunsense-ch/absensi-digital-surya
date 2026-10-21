<x-app-layout>
    <x-slot name="header"><h2>Dashboard Admin</h2></x-slot>

    <p style="font-size:13px;color:var(--muted);margin:0 0 18px;">
        Selamat datang, <strong style="color:var(--primary-dark);">{{ auth()->user()->name }}</strong>. Berikut ringkasan sistem hari ini.
    </p>

    <div class="grid-4" style="margin-bottom:18px;">
        <div class="card stat">
            <span>Total Siswa</span>
            <b>{{ $totalSiswa }}</b>
        </div>
        <div class="card stat">
            <span>Total Kelas</span>
            <b>{{ $totalKelas }}</b>
        </div>
        <div class="card stat">
            <span>Lokasi QR Aktif</span>
            <b>{{ $totalLokasi }}</b>
        </div>
        <div class="card stat">
            <span>Absen Hari Ini</span>
            <b>{{ $absenHariIni }}</b>
        </div>
    </div>

    <div class="card">
        <p class="section-title">Absensi Hari Ini</p>
        <table>
            <thead>
                <tr><th>Siswa</th><th>Lokasi</th><th>Tanggal</th><th>Waktu</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($recentAttendances as $attendance)
                    <tr>
                        <td>
                            <span class="av"></span>{{ $attendance->student->full_name ?? '—' }}
                        </td>
                        <td>{{ $attendance->qrLocation->name ?? '—' }}</td>
                        <td>{{ $attendance->attendance_date->format('d-m-Y') }}</td>
                        <td>{{ $attendance->attendance_time }}</td>
                        <td>
                            @php
                                $badge = match($attendance->status) {
                                    'hadir' => 'ok',
                                    'izin', 'sakit' => 'warn',
                                    default => 'danger',
                                };
                            @endphp
                            <span class="badge {{ $badge }}">{{ ucfirst($attendance->status) }}</span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">
                        <div class="empty-state">Belum ada siswa yang absen hari ini.</div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
