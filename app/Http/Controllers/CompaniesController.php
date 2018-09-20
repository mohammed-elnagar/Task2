<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

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
        $companies = Company::paginate(10);
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
        //
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
    }
}
