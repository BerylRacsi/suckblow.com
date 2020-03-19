<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Partner;
use File;
use Image;

class PartnerController extends Controller
{
    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required',  'email' => 'email:rfc,dns'],
            'phone' => ['required','string', 'min:8','max:15'],
            'address' => ['required','string', 'max:100'],
            'category' => ['required'],
            'country' => ['required'],
            'province' => ['required','string','max:25'],
            'city' => ['required','string','max:25'],

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
        $partners = Partner::all();

        return view('admin/account/partner/index',compact('partners'));
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
        $partner = Partner::find($id);

        return view('admin/account/partner/edit',compact('partner'));
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

        $partner = Partner::find($id);

        $partner->name = $request->input('name');
        $partner->email = $request->input('email');
        $partner->phone = $request->input('phone');
        $partner->category = $request->input('category');
        $partner->country = $request->input('country');
        $partner->province = $request->input('province');
        $partner->city = $request->input('city');
        $partner->address = $request->input('address');

        if ($request->hasFile('image')) {
            File::delete($partner->image);

            $avatar = $request->file('image');

            $filename = rand(1111,9999).time().'.'.$avatar->getClientOriginalExtension();
            $image_path = 'images/partner_avatar/'.$filename;

            Image::make($avatar)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);

            $partner->image = $image_path;
        }

        $partner->save();

        return redirect()->intended('admin/partner-account')->with('success','Account edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);

        $image = $partner->image;

        File::delete($image);

        $partner->delete();

        return redirect()->intended('admin/partner-account')->with('success','Account removed');
    }
}
