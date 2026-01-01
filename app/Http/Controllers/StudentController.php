<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ParentModel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('parent');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('class', 'like', "%{$search}%");
            });
        }

        $students = $query->latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $parents = ParentModel::all();
        return view('students.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis',
            'class' => 'required|string|max:50',
            'uid' => 'nullable|string|unique:students,uid',
            'parent_id' => 'required|exists:parents,id',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit(Student $student)
    {
        $parents = ParentModel::all();
        return view('students.edit', compact('student', 'parents'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis,' . $student->id,
            'class' => 'required|string|max:50',
            'uid' => 'nullable|string|unique:students,uid,' . $student->id,
            'parent_id' => 'required|exists:parents,id',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
