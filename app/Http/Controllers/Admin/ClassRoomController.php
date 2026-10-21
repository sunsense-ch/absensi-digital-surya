<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    // Menampilkan daftar semua kelas (dipanggil saat GET /admin/classes)
    public function index()
    {
        // latest() = urutkan dari yang terbaru dibuat
        // paginate(10) = tampilkan 10 data per halaman, sisanya otomatis dibagi ke halaman lain
        $classes = ClassRoom::latest()->paginate(10);

        return view('admin.classes.index', compact('classes'));
    }

    // Menampilkan form tambah kelas (dipanggil saat GET /admin/classes/create)
    public function create()
    {
        return view('admin.classes.create');
    }

    // Memproses data dari form tambah kelas (dipanggil saat POST /admin/classes)
    public function store(Request $request)
    {
        // Validasi input sebelum disimpan ke database
        // 'required' = wajib diisi, 'max:100' = maksimal 100 karakter
        // 'nullable' = boleh kosong
        $validated = $request->validate([
            'class_name' => ['required', 'string', 'max:100'],
            'major' => ['nullable', 'string', 'max:100'],
        ]);

        // Simpan data yang sudah tervalidasi ke database
        ClassRoom::create($validated);

        // Redirect kembali ke halaman daftar kelas + pesan sukses (flash message)
        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    // Menampilkan form edit kelas tertentu (dipanggil saat GET /admin/classes/{class}/edit)
    // Laravel otomatis mengambilkan data ClassRoom berdasarkan ID di URL (Route Model Binding)
    public function edit(ClassRoom $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    // Memproses data dari form edit (dipanggil saat PUT/PATCH /admin/classes/{class})
    public function update(Request $request, ClassRoom $class)
    {
        $validated = $request->validate([
            'class_name' => ['required', 'string', 'max:100'],
            'major' => ['nullable', 'string', 'max:100'],
        ]);

        // Update data kelas yang sudah ada dengan data baru
        $class->update($validated);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    // Menghapus data kelas (dipanggil saat DELETE /admin/classes/{class})
    public function destroy(ClassRoom $class)
    {
        $class->delete();

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}