<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;
use Validator;
class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee::with('company:id,name')->orderBy('created_at', 'desc')->paginate(10);
        return view('app.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $companies = Company::get(['id', 'name']);
        return view('app.employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data  = $request->all();
         $rules =
                 [

                  'company_id'   => 'required|exists:companies,id',
                  'name'         => 'required|string',
                  'last_name'    => 'required|string',
                  'email'        => 'required|email|unique:employees',
                  'phone'        => 'required',
                 ];

         $validation = Validator::make($data,$rules);
         dd($validation);
         if($validation->fails()){
             return redirect()->back()->withErrors($validation);
         }

         Employee::create($request->all());
         return redirect()->back()->with('alert-success', 'Your data has been inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $employee = Employee::with('company')->find($id);

        if($employee == null){
            return view('errors.404');
        }
        return view('app.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employee  = Employee::find($id);
        $companies = Company::get(['id', 'name']);
        if($employee){
            return view('app.employees.create', compact('employee', 'companies'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules =
                [

                 'company_id'   => 'required|exists:companies,id',
                 'name'         => 'required|string',
                 'last_name'    => 'required|string',
                 'email'        => 'required|email|unique:employees,email,'.$id,
                 'phone'        => 'required',
                ];

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }
        $employee = Employee::find($id);
        if($employee){
            $employee->company_id    = $request->company_id;
            $employee->name          = $request->name;
            $employee->last_name     = $request->last_name;
            $employee->email         = $request->email;
            $employee->phone         = $request->phone;
            $employee->update();
        }
        return redirect()->back()->with('alert-success', 'Your data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employee = Employee::find($id);
        if($employee){
            $employee->delete();
            return redirect()->back()->with('alert-success', 'Your data has been deleted');
        }else {
            return redirect()->back()->with('alert-danger', 'Your data not found');
        }
    }
}
