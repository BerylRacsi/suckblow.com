<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Admin;

class AdminController extends Controller
{
    protected function validatorStore(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required',  'email' => 'email:rfc,dns', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required',  'email' => 'email:rfc,dns'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();

        return view('admin/account/administrator/index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/account/administrator/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validatorStore($request->all())->validate();

        $admin = new Admin;

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');

        $admin->save();

        return redirect()->intended('admin/admin-account')->with('success','Account created.');
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
        $admin = Admin::find($id);

        return view('admin/account/administrator/edit',compact('admin'));
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
        $this->validatorUpdate($request->all())->validate();

        $admin = Admin::find($id);

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');

        $admin->save();

        return redirect()->intended('admin/admin-account')->with('success','Account edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);

        $admin->delete();

        return redirect()->intended('admin/admin-account')->with('success','Account removed.');
    }
}
