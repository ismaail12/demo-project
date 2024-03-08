<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->keyword;
        $row_count = 4;
        $data = null;
        if (strlen($keyword)) {
            $data = Student::where('std_number', 'like', "%$keyword%")
                ->orWhere('name', 'like', "%$keyword%")
                ->orWhere('department', 'like', "%$keyword%")
                ->paginate($row_count);
        } else {
            $data = Student::orderBy('std_number', 'desc')->paginate($row_count);
        }
        return view('student.index')->with('data', $data);
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        Session::flash('std_number', $request->std_number);
        Session::flash('name', $request->name);
        Session::flash('department', $request->department);

        $request->validate([
            'std_number' => 'required|numeric|unique:students,std_number',
            'name' => 'required',
            'department' => 'required',
        ], [
            'std_number.required' => 'NIM wajib diisi',
            'std_number.numeric' => 'NIM wajib dalam angka',
            'std_number.unique' => 'NIM yang diisikan sudah ada dalam database',
            'name.required' => 'Nama wajib diisi',
            'department.required' => 'Jurusan wajib diisi',
        ]);
        $data = [
            'std_number' => $request->std_number,
            'name' => $request->name,
            'department' => $request->department,
        ];
        Student::create($data);
        return redirect()->to('students')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $data = Student::where('std_number', $id)->first();
        return view('student.edit')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'department' => 'required',
        ], [
            'name.required' => 'name wajib diisi',
            'department.required' => 'department wajib diisi',
        ]);
        $data = [
            'name' => $request->name,
            'department' => $request->department,
        ];
        Student::where('std_number', $id)->update($data);
        return redirect()->to('students')->with('success', 'Berhasil melakukan update data');
    }

    public function destroy($id)
    {
        Student::where('std_number', $id)->delete();
        return redirect()->to('students')->with('success', 'Berhasil melakukan delete data');
    }
}
