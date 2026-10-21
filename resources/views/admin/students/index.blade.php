<x-app-layout>
    <x-slot name="header"><h2>Data Siswa</h2></x-slot>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="toolbar">
            <p style="font-size:12.5px;color:var(--muted);margin:0;">{{ $students->total() }} siswa terdaftar</p>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary">+ Tambah Siswa</a>
        </div>

        <table>
            <thead>
                <tr><th>NIS</th><th>Nama Lengkap</th><th>Kelas</th><th>Akun</th><th style="text-align:right;">Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->nis }}</td>
                        <td style="font-weight:600;color:var(--primary-dark);">
                            <span class="av"></span>{{ $student->full_name }}
                        </td>
                        <td>
                            @if($student->classRoom)
                                <span class="badge ok">{{ $student->classRoom->class_name }}</span>
                            @else
                                <span style="color:var(--muted);">—</span>
                            @endif
                        </td>
                        <td>
                            @if($student->user)
                                <span class="badge ok">Terhubung</span>
                            @else
                                <span class="badge warn">Belum terhubung</span>
                            @endif
                        </td>
                        <td style="text-align:right;">
                            <a href="{{ route('admin.students.edit', $student) }}" class="icon-btn">Edit</a>
                            <form action="{{ route('admin.students.destroy', $student) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn" style="color:var(--danger);"
                                    onclick="return confirm('Hapus data siswa ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">
                        <div class="empty-state">
                            Belum ada siswa yang ditambahkan.
                            <a href="{{ route('admin.students.create') }}">Tambahkan siswa pertama</a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>

        @if($students->hasPages())
            <div style="margin-top:14px;">{{ $students->links() }}</div>
        @endif
    </div>
</x-app-layout>
