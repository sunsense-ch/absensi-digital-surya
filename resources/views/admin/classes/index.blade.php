<x-app-layout>
    <x-slot name="header"><h2>Data Kelas</h2></x-slot>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="toolbar">
            <p style="font-size:12.5px;color:var(--muted);margin:0;">{{ $classes->total() }} kelas terdaftar</p>
            <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">+ Tambah Kelas</a>
        </div>

        <table>
            <thead>
                <tr><th>Nama Kelas</th><th>Jurusan</th><th style="text-align:right;">Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($classes as $class)
                    <tr>
                        <td style="font-weight:600;color:var(--primary-dark);">{{ $class->class_name }}</td>
                        <td>{{ $class->major ?? '—' }}</td>
                        <td style="text-align:right;">
                            <a href="{{ route('admin.classes.edit', $class) }}" class="icon-btn">Edit</a>
                            <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn" style="color:var(--danger);"
                                    onclick="return confirm('Hapus data kelas ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3">
                        <div class="empty-state">
                            Belum ada kelas yang ditambahkan.
                            <a href="{{ route('admin.classes.create') }}">Tambahkan kelas pertama</a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>

        @if($classes->hasPages())
            <div style="margin-top:14px;">{{ $classes->links() }}</div>
        @endif
    </div>
</x-app-layout>
