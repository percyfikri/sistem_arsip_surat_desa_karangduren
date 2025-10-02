<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letters;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function arsip(Request $request)
    {
        $query = Letters::with('category')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%")
                    ->orWhereHas('category', function ($qc) use ($search) {
                        $qc->where('name_category', 'like', "%$search%");
                    });
            });
        }

        $letters = $query->get();
        $categories = Categories::all();
        return view('content.arsip', compact('letters', 'categories'));
    }

    public function storeArsip(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'title' => 'required|string|max:255',
            'file_surat' => 'required|mimes:pdf|max:5120',
        ]);

        // Simpan data surat tanpa path dulu untuk mendapatkan nomor auto increment
        $letter = Letters::create([
            'nomor_surat' => $validated['nomor_surat'],
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'path' => '', // sementara kosong
        ]);

        // Simpan file dengan nama: {nomor_surat}_{nama_asli}
        $file = $request->file('file_surat');
        $fileName = $letter->nomor_surat . '_' . $file->getClientOriginalName();
        $file->storeAs('arsip', $fileName, 'public');

        // Update path di database
        $letter->path = 'arsip/' . $fileName;
        $letter->save();

        return redirect()->route('admin.arsip')->with('success', 'Surat berhasil diarsipkan.');
    }

    public function editArsip($id)
    {
        $letter = Letters::findOrFail($id);
        $categories = Categories::all();
        return view('content.edit_arsip', compact('letter', 'categories'));
    }

    public function updateArsip(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'title' => 'required|string|max:255',
            'file_surat' => 'nullable|mimes:pdf|max:5120',
        ]);

        $letter = Letters::findOrFail($id);

        // Jika ada file baru, hapus file lama lalu simpan file baru
        if ($request->hasFile('file_surat')) {
            // Hapus file lama jika ada
            if ($letter->path && Storage::disk('public')->exists($letter->path)) {
                Storage::disk('public')->delete($letter->path);
            }
            // Simpan file baru dengan nama: {nomor_surat}_{nama_asli}
            $file = $request->file('file_surat');
            $fileName = $letter->nomor_surat . '_' . $file->getClientOriginalName();
            $file->storeAs('arsip', $fileName, 'public');
            $letter->path = 'arsip/' . $fileName;
        }

        $letter->nomor_surat = $validated['nomor_surat'];
        $letter->category_id = $validated['category_id'];
        $letter->title = $validated['title'];
        $letter->save();

        return redirect()->route('admin.arsip')->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroyArsip($id)
    {
        $letter = Letters::findOrFail($id);

        // Hapus file PDF dari storage jika ada
        if ($letter->path && Storage::disk('public')->exists($letter->path)) {
            Storage::disk('public')->delete($letter->path);
        }

        $letter->delete();
        return redirect()->route('admin.arsip')->with('success', 'Surat berhasil dihapus.');
    }

    // TAMPILKAN DAFTAR CATEGORY
    public function category(Request $request)
    {
        $query = Categories::query();
        if ($request->has('search')) {
            $query->where('name_category', 'like', '%' . $request->search . '%');
        }
        $categories = $query->orderBy('category_id')->get();
        return view('content.category', compact('categories'));
    }

    // TAMBAH CATEGORY
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name_category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        Categories::create($validated);
        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // EDIT CATEGORY (tampilkan form edit)
    public function editCategory($id)
    {
        $category = Categories::findOrFail($id);
        return view('content.edit_category', compact('category'));
    }

    // UPDATE CATEGORY
    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'name_category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        $category = Categories::findOrFail($id);
        $category->update($validated);
        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // HAPUS CATEGORY
    public function destroyCategory($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil dihapus.');
    }

    // ABOUT PAGE
    public function about()
    {
        // Ambil user pertama (atau sesuaikan dengan kebutuhan)
        $user = User::first();
        return view('content.about', compact('user'));
    }
}
