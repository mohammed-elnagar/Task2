<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Validator;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = Company::orderBy('created_at', 'desc')->paginate(10);
        return view('app.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('app.companies.create');

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
                 'name'         => 'required|string',
                 'email'        => 'required|email|unique:companies',
                 'address'      => 'required',
                 'website'      => 'required',
                 'logo'         => 'required|mimes:jpeg|dimensions:min_width=300,min_height=300',
                ];

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

        if ($request['logo']) {
            $file = $request['logo'];
            // dd($file);
            $file_name = md5((string)mt_rand(1, 100000)) . '.' . $request['logo']->getClientOriginalExtension();
            $path = $file->storeAs('upload/image', $file_name);
            if (file_exists($path)) {
                $file_name = '_' . $file_name;
                $path = $file->storeAs('upload/image', $file_name);
            }
            $file->move('upload/image', $file_name);
        }else{
            $file_name = 'default.jpeg';
        }

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'website' => $request->website,
            'logo' => $file_name,
        ]);
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
        $company = Company::find($id);

        if($company == null){
            return view('errors.404');
        }
        return view('app.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        if($company){
            return view('app.companies.create', compact('company'));
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
        //
        $data  = $request->all();
        $rules =
                [
                 'name'         => 'required|string',
                 'email'        => 'required|email',
                 'address'      => 'required',
                 'website'      => 'required',
                 'logo'         => 'required|mimes:jpeg|dimensions:width=300,height=300',
                ];

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }
        $company = Company::find($id);
        if($company){
            $company->name      = $request->name;
            $company->email     = $request->email;
            $company->address   = $request->address;
            $company->website   = $request->website;

            $file = $request['logo'];
            $file_name = md5((string)mt_rand(1, 100000)) . '.' . $request['logo']->getClientOriginalExtension();
            $path = $file->storeAs('upload/image', $file_name);
            if (file_exists($path)) {
                $file_name = '_' . $file_name;
                $path = $file->storeAs('upload/image', $file_name);
            }
            $file->move('upload/image', $file_name);
            $company->logo   = $file_name;

            $company->update();
            return redirect(route('companies.index'))->with('alert-success', 'Your data has been updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if($company){
            $company->delete();
            return redirect()->back()->with('alert-success', 'Your data has been deleted');
        }else {
            return redirect()->back()->with('alert-danger', 'Your data not found');
        }
    }
}
