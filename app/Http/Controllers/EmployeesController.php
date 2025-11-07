<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empeloyee;
use App\Models\Role;

class EmployeesController extends Controller
{
    public function index()
    {
        $employee = Empeloyee::all();
        return view('employee.index', compact('employee'));
    }

    public function create()
    {
        $role = Role::all();
        return view('employee.create', compact('role'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'role_id' => 'required'
        ]);

        Empeloyee::create($validated);
        return redirect()->route('employee.index')->with('success','Data Admin Baru Berhasil Di Tambahkan');
    }

    public function edit(Empeloyee $employee)
    {
        $role = Role::all();
        return view('employee.edit', compact('role','employee'));
    }

    public function update(Request $request, Empeloyee $employee)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'role_id' => 'required'
        ]);
        //jika berhasil validate data maka update data
        //
        $employee->update($validated);
        return redirect()->route('employee.index')->with('success','Data Admin Berhasil Di Rubah');
    }

    public function destroy($id){

        $employee = Empeloyee::findOrfail($id);
        $employee->delete();
        return redirect()->route('employee.index')->with('success','Data Admin Berhasil Di Hapus ');
    }

}
