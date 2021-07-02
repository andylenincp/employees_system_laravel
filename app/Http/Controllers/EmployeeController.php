<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        return view('employee.index', [
            'employees' => Employee::paginate(5)
        ]);
        */
        $employees = Employee::paginate(1);
        return view('employee.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fields = [
            'name' => 'required|string|max:100',
            'father_lastname' => 'required|string|max:100',
            'mother_lastname' => 'required|string|max:100',
            'email' => 'required|email',
            'photo' => 'required|max:10000|mimes:jpeg,png,jpg'
        ];

        $message = [
            'required' => 'The :attribute is required',
            'photo.required' => 'The photo is required'
        ];

        $this->validate($request, $fields, $message);

        $employee = new Employee($request->all());
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $name = 'employee_' .time() . '.' . $photo->getClientOriginalExtension();
            $path = public_path() . '/img/employees/';
            $photo->move($path, $name);
            $employee->photo = $name;
        }
        $employee->save();
        return redirect('employee')->with('message', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('employee.edit')->with('employee', $employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $fields = [
            'name' => 'required|string|max:100',
            'father_lastname' => 'required|string|max:100',
            'mother_lastname' => 'required|string|max:100',
            'email' => 'required|email'
        ];

        $message = [
            'required' => 'The :attribute is required'
        ];

        if ($request->file('photo')) {
            $fields = ['photo' => 'required|max:10000|mimes:jpeg,png,jpg'];
            $message = ['photo.required' => 'The photo is required'];
        }

        $this->validate($request, $fields, $message);

        $employee = Employee::find($id);
        $employee->fill($request->all());
        if ($request->file('photo')) {

            // Borra el archivo anterior
            $employeePhoto = Employee::find($id);
            unlink(public_path() . '/img/employees/'.$employeePhoto->photo);
            
            $photo = $request->file('photo');
            $name = 'employee_' .time() . '.' . $photo->getClientOriginalExtension();
            $path = public_path() . '/img/employees/';
            $photo->move($path, $name);
            $employee->photo = $name;
        }
        $employee->save();
        return redirect('employee')->with('message', 'Employee updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        unlink(public_path() . '/img/employees/'.$employee->photo);
        $employee->delete();
        return redirect('employee')->with('message', 'Employee deleted successfully');
    }
}
