<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use File;
use Image;

class UserController extends Controller
{
    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email' => 'email:rfc,dns'],
            'phone' => ['required','string', 'min:8','max:15'],
            'address' => ['required','string', 'max:100'],
            'nationality' => ['required'],

            'image' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin/account/user/index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = User::find($id);

        return view('admin/account/user/edit',compact('user'));
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

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        if ($request->hasFile('image')) {
            File::delete($user->image);

            $avatar = $request->file('image');

            $filename = rand(1111,9999).time().'.'.$avatar->getClientOriginalExtension();
            $image_path = 'images/user_avatar/'.$filename;

            Image::make($avatar)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);

            $user->image = $image_path;
        }

        $user->save();

        return redirect()->intended('admin/user-account')->with('status','Account edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $image = $user->image;

        File::delete($image);

        $user->delete();

        return redirect()->intended('admin/user-account')->with('status','Account removed');
    }
}
