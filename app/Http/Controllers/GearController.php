<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Gear;
use File;
use Image;
use Alert;

class GearController extends Controller
{
    protected function guardCheck()
    {
        if(Auth::guard('admin')->check()){   
            return "admin";
        }
        else if(Auth::guard('partner')->check()){
            return "partner";
        }
        else if(Auth::guard('web')->check()){
            return "user";
        }
        else{
            return "guest";
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'description' => ['required','max:150'],
            'price' => ['required','numeric','max:1000000000000','min:1000'],
            'category' => ['required'],
            'link' => ['required', 'string', 'max:50'],
            'condition' => ['required','boolean'],
            'warranty' => ['required','boolean'],
            
            'image.*' => 'image',
        ]);
    }

    public function selected($category)
    {
        $gears = Gear::where('category',$category)->get();

        return view('main/gear/index',compact('gears'));
    }

    public function search(Request $request)
    {
        $keyword =  $request->search;

        $gears = Gear::where('name' , 'LIKE' , '%' . $keyword . '%')
                        ->orWhere('description' , 'LIKE' , '%' . $keyword . '%')
                        ->orWhere('category' , 'LIKE' , '%' . $keyword . '%')
                        ->get();

        return view('main/gear/index',compact('gears'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gears = Gear::all();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/gear/index',compact('gears'));
                break;
            
            default:
                return view('main/gear/index',compact('gears'));
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/gear/create');
                break;
            
            default:
                return view('main/gear/create');
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $gear = new Gear;
        $gear->name = $request->input('name');
        $gear->description = $request->input('description');
        $gear->price = $request->input('price');
        $gear->condition = $request->input('condition');
        $gear->warranty = $request->input('warranty');
        $gear->link = $request->input('link');
        $gear->category = $request->input('category');

        if ($request->hasFile('image')) {
            $images = $request->file('image');
 
            //setting flag for condition
            $org_img = true;

            $path = [];
 
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/gear/')) {
                $org_img = File::makeDirectory('images/gear/', 0777, true);
            }


            // validation
            if (sizeof($images)>5) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload, only up to 5 images are allowed.');
            }

            foreach ($images as $key => $image) {
                $name = $image->getClientOriginalName();

                if (!in_array($image->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                    return back()
                        ->withInput($request->all())
                        ->withErrors('Failed to upload image : '.$name.', only JPG, PNG, and JPEG are allowed.');
                }
                if ($image->getSize() > 1000000) {
                    return back()
                        ->withInput($request->all())
                        ->withErrors('Failed to upload image : '.$name.', maximum allowed image size is 1 MB.');
                }
            }

            // loop through each image to save and upload
            foreach($images as $key => $image) {
                
                //get file name of image  and concatenate with 4 random integer for unique
                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

                //path of image for upload
                $org_path = 'images/gear/' . $filename;

                $path[$key] = $org_path;

                if (($org_img ) == true) {
                   Image::make($image)->fit(640, 640, function ($constraint) {
                           $constraint->upsize();
                       })->save($org_path);
                }
            }
            $stringpath = implode(',', $path);
            $gear->image = $stringpath;

        }

        else {
            return back()
                ->withInput($request->all())
                ->withErrors('You need to upload at least 1 image.');
        }

        $gear->save();


        $role = $this->guardCheck();


        switch ($role) {
            case 'admin':
                return redirect()->intended('admin/gear')->with('success','Ads Submitted.');
                break;

            default:
                return redirect()->intended('gear')->with('success','Ads Submitted.');
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gear = Gear::find($id);

        $query = Gear::where('category',$gear->category)->inRandomOrder()->limit(12)->get();
        $related = $query->except($id);

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/gear/detail',compact('gear'));
                break;
            
            default:
                return view('main/gear/detail',compact('gear','related'));
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gear = Gear::find($id);

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/gear/edit',compact('gear'));
                break;
            
            default:
                return view('welcome');
                break;
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
        $this->validator($request->all())->validate();

        $gear = Gear::find($id);
        $gear->name = $request->input('name');
        $gear->description = $request->input('description');
        $gear->price = $request->input('price');
        $gear->condition = $request->input('condition');
        $gear->warranty = $request->input('warranty');
        $gear->link = $request->input('link');
        $gear->category = $request->input('category');

        if ($request->hasFile('image')) {
            $imagearray = explode(',', $gear->image);
            foreach ($imagearray as $image) {
                File::delete($image);
            }

            $images = $request->file('image');

            //setting flag for condition
            $org_img = true;

            $path = [];

            // validation
            if (sizeof($images)>5) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload, only up to 5 images are allowed.');
            }

            foreach ($images as $key => $image) {
                $name = $image->getClientOriginalName();

                //validation
                if (!in_array($image->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                    return back()
                        ->withInput($request->all())
                        ->withErrors('Failed to upload image : '.$name.', only JPG, PNG, and JPEG are allowed.');
                }
                if ($image->getSize() > 1000000) {
                    return back()
                        ->withInput($request->all())
                        ->withErrors('Failed to upload image : '.$name.', maximum allowed image size is 1 MB.');
                }
            }

            // loop through each image to save and upload
            foreach($images as $key => $image) {
                
                //get file name of image  and concatenate with 4 random integer for unique
                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

                //path of image for upload
                $org_path = 'images/gear/' . $filename;

                $path[$key] = $org_path;

                if (($org_img ) == true) {
                   Image::make($image)->fit(640, 640, function ($constraint) {
                           $constraint->upsize();
                       })->save($org_path);
                }
            }
            $stringpath = implode(',', $path);
            $gear->image = $stringpath;
        }

        $gear->save();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':

                return redirect()->intended('admin/gear')->with('success','Ads Edited.');
                break;
            
            default:
                return redirect()->intended('/')->with('success','Ads Edited.');
                break;
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
        $gear = Gear::find($id);

        $imagearray = explode(',', $gear->image);
        foreach ($imagearray as $image) {
            File::delete($image);
        }

        $gear->delete();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':

                return redirect()->intended('admin/gear')->with('success','Ads Removed.');
                break;
            
            default:
                return redirect()->intended('/')->with('success','Ads Removed.');
                break;
        }
    }
}
