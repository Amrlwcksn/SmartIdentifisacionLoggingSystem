<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index(Request $request)
    {
        $query = ParentModel::withCount('students');

        if ($request->has('search') && !empty($request->get('search'))) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('telegram_id', 'like', "%{$search}%")
                  ->orWhereHas('students', function($sq) use ($search) {
                      $sq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $parents = $query->latest()->paginate(10);
        return view('parents.index', compact('parents'));
    }

    public function create()
    {
        return view('parents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'telegram_id' => 'nullable|string|max:50',
        ]);

        ParentModel::create($request->all());

        return redirect()->route('parents.index')->with('success', 'Data wali berhasil ditambahkan!');
    }

    public function edit(ParentModel $parent)
    {
        return view('parents.edit', compact('parent'));
    }

    public function update(Request $request, ParentModel $parent)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'telegram_id' => 'nullable|string|max:50',
        ]);

        $parent->update($request->all());

        return redirect()->route('parents.index')->with('success', 'Data wali berhasil diperbarui!');
    }

    public function destroy(ParentModel $parent)
    {
        if ($parent->students()->count() > 0) {
            return redirect()->route('parents.index')->with('error', 'Tidak dapat menghapus wali yang memiliki siswa terdaftar!');
        }

        $parent->delete();
        return redirect()->route('parents.index')->with('success', 'Data wali berhasil dihapus!');
    }
}
