<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letters;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function arsip()
    {
        $letters = Letters::with('category')->latest()->get();
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

        // Simpan file dengan nama asli
        $file = $request->file('file_surat');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('arsip', $fileName, 'public');

        Letters::create([
            'nomor_surat' => $validated['nomor_surat'],
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'path' => 'arsip/' . $fileName,
        ]);

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
            'file_surat' => 'nullable|mimes:pdf|max:2048',
        ]);

        $letter = Letters::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat')->store('arsip', 'public');
            $letter->path = $file;
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
}
