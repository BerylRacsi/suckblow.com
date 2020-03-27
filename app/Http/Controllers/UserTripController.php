<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\UserTrip;
use File;
use Image;
use Alert;

class UserTripController extends Controller
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
            'price' => ['required','numeric','max:1000000000000','min:100'],
            'location' => ['required','string'],
            'length' => ['required','numeric','max:100','min:1'],

            'itinerary.*' => ['image'],
            'image.*' => ['image'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = UserTrip::all();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/usertrip/index',compact('trips'));
                break;
            
            default:
                return view('welcome');
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
                return view('admin/advertisement/usertrip/create');
                break;
            
            default:
                return view('main/trip/create-user');
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

        $trip = new UserTrip;
        $trip->name = $request->input('name');
        $trip->description = $request->input('description');
        $trip->price = $request->input('price');
        $trip->location = $request->input('location');
        $trip->length = $request->input('length');

        if ($request->hasFile('itinerary') && $request->hasFile('image')) {

            //itinerary
            $itinerary = $request->file('itinerary');

            $dir_img = true;

            if( ! File::exists('images/itinerary/')) {
                $dir_img = File::makeDirectory('images/itinerary/', 0777, true);
            }

            //images
            $images = $request->file('image');
 
            $org_img = true;

            $path = [];
 
            if( ! File::exists('images/user_trip_photos/')) {
                $org_img = File::makeDirectory('images/user_trip_photos/', 0777, true);
            }

            //validationItinerary
            $nameItinerary = $itinerary->getClientOriginalName();

            if (!in_array($itinerary->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameItinerary.', only JPG, PNG, and JPEG are allowed.');
            }

            if ($itinerary->getSize() > 1000000) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameItinerary.', maximum allowed image size is 1 MB.');
            }

            // validationImages
            if (sizeof($images)>5) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload, only up to 5 images are allowed.');
            }

            foreach ($images as $key => $image) {
                $nameImages = $image->getClientOriginalName();

                if (!in_array($image->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                    return back()
                        ->withInput($request->all())
                        ->withErrors('Failed to upload image : '.$nameImages.', only JPG, PNG, and JPEG are allowed.');
                }
                if ($image->getSize() > 1000000) {
                    return back()
                        ->withInput($request->all())
                        ->withErrors('Failed to upload image : '.$nameImages.', maximum allowed image size is 1 MB.');
                }
            }

            // Itinerary
            $filenameitinerary = rand(1111,9999).time().'.'.$itinerary->getClientOriginalExtension();
            $image_path = 'images/itinerary/'.$filenameitinerary;

            Image::make($itinerary)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);
            
            $trip->itinerary = $image_path;

            // Images
            foreach($images as $key => $image) {
                
                //get file name of image  and concatenate with 4 random integer for unique
                $filenameImages = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

                //path of image for upload
                $org_path = 'images/user_trip_photos/' . $filenameImages;

                $path[$key] = $org_path;

                if (($org_img ) == true) {
                   Image::make($image)->fit(640, 640, function ($constraint) {
                           $constraint->upsize();
                       })->save($org_path);
                }
            }
            $stringpath = implode(',', $path);
            $trip->image = $stringpath;
        }

        else if(!$request->hasFile('itinerary')){
            return back()
                ->withInput($request->all())
                ->withErrors('You need to upload an image for itinerary.');
        }
        else if(!$request->hasFile('image')){
            return back()
                ->withInput($request->all())
                ->withErrors('You need to upload at least 1 image for photos.');
        }

        $trip->save();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':

                return redirect()->intended('admin/usertrip')->with('success','Ads Submitted.');
                break;
            
            default:
                return redirect()->intended('trip')->with('success','Ads Submitted.');
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
        $trip = UserTrip::find($id);

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/usertrip/detail',compact('trip'));
                break;
            
            default:
                return view('main/trip/detail-user',compact('trip'));
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
        $trip = UserTrip::find($id);

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/usertrip/edit',compact('trip'));
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

        $trip = UserTrip::find($id);
        $trip->name = $request->input('name');
        $trip->description = $request->input('description');
        $trip->price = $request->input('price');
        $trip->location = $request->input('location');
        $trip->length = $request->input('length');

        if ($request->hasFile('itinerary') && $request->hasFile('image')) {
            //itinerary old delete
            $itineraryOld = $trip->itinerary;
            File::delete($itineraryOld);

            //images old delete
            $imagearray = explode(',', $trip->image);
            foreach ($imagearray as $image) {
                File::delete($image);
            }

            //itinerary
            $itinerary = $request->file('itinerary');

            $dir_img = true;

            if( ! File::exists('images/itinerary/')) {
                $dir_img = File::makeDirectory('images/itinerary/', 0777, true);
            }

            //images
            $images = $request->file('image');
 
            $org_img = true;

            $path = [];
 
            if( ! File::exists('images/user_trip_photos/')) {
                $org_img = File::makeDirectory('images/user_trip_photos/', 0777, true);
            }

            //validationItinerary
            $nameItinerary = $itinerary->getClientOriginalName();

            if (!in_array($itinerary->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameItinerary.', only JPG, PNG, and JPEG are allowed.');
            }

            if ($itinerary->getSize() > 1000000) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameItinerary.', maximum allowed image size is 1 MB.');
            }

            // validationImages
            if (sizeof($images)>5) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload, only up to 5 images are allowed.');
            }

            foreach ($images as $key => $image) {
                $nameImages = $image->getClientOriginalName();

                if (!in_array($image->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                    return back()
                        ->withInput($request->all())
                        ->withErrors('Failed to upload image : '.$nameImages.', only JPG, PNG, and JPEG are allowed.');
                }
                if ($image->getSize() > 1000000) {
                    return back()
                        ->withInput($request->all())
                        ->withErrors('Failed to upload image : '.$nameImages.', maximum allowed image size is 1 MB.');
                }
            }

            // Itinerary
            $filenameitinerary = rand(1111,9999).time().'.'.$itinerary->getClientOriginalExtension();
            $image_path = 'images/itinerary/'.$filenameitinerary;

            Image::make($itinerary)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);
            
            $trip->itinerary = $image_path;

            // Images
            foreach($images as $key => $image) {
                
                //get file name of image  and concatenate with 4 random integer for unique
                $filenameImages = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

                //path of image for upload
                $org_path = 'images/user_trip_photos/' . $filenameImages;

                $path[$key] = $org_path;

                if (($org_img ) == true) {
                   Image::make($image)->fit(640, 640, function ($constraint) {
                           $constraint->upsize();
                       })->save($org_path);
                }
            }
            $stringpath = implode(',', $path);
            $trip->image = $stringpath;
        }

        else if($request->hasfile('itinerary')) {
            //itinerary old delete
            $itineraryOld = $trip->itinerary;
            File::delete($itineraryOld);

            //itinerary
            $itinerary = $request->file('itinerary');

            $dir_img = true;

            if( ! File::exists('images/itinerary/')) {
                $dir_img = File::makeDirectory('images/itinerary/', 0777, true);
            }

            //validationItinerary
            $nameItinerary = $itinerary->getClientOriginalName();

            if (!in_array($itinerary->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameItinerary.', only JPG, PNG, and JPEG are allowed.');
            }

            if ($itinerary->getSize() > 1000000) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameItinerary.', maximum allowed image size is 1 MB.');
            }

            // Itinerary
            $filenameitinerary = rand(1111,9999).time().'.'.$itinerary->getClientOriginalExtension();
            $image_path = 'images/itinerary/'.$filenameitinerary;

            Image::make($itinerary)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);
            
            $trip->itinerary = $image_path;
        }

        else if($request->hasfile('image')) {
            //images old delete
            $imagearray = explode(',', $trip->image);
            foreach ($imagearray as $image) {
                File::delete($image);
            }

            //images
            $images = $request->file('image');
 
            $org_img = true;

            $path = [];
 
            if( ! File::exists('images/user_trip_photos/')) {
                $org_img = File::makeDirectory('images/user_trip_photos/', 0777, true);
            }

            // validationImages
            if (sizeof($images)>5) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload, only up to 5 images are allowed.');
            }

            foreach ($images as $key => $image) {
                $nameImages = $image->getClientOriginalName();

                if (!in_array($image->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                    return back()
                        ->withInput($request->all())
                        ->withErrors('Failed to upload image : '.$nameImages.', only JPG, PNG, and JPEG are allowed.');
                }
                if ($image->getSize() > 1000000) {
                    return back()
                        ->withInput($request->all())
                        ->withErrors('Failed to upload image : '.$nameImages.', maximum allowed image size is 1 MB.');
                }
            }

            // Images
            foreach($images as $key => $image) {
                
                //get file name of image  and concatenate with 4 random integer for unique
                $filenameImages = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

                //path of image for upload
                $org_path = 'images/user_trip_photos/' . $filenameImages;

                $path[$key] = $org_path;

                if (($org_img ) == true) {
                   Image::make($image)->fit(640, 640, function ($constraint) {
                           $constraint->upsize();
                       })->save($org_path);
                }
            }
            $stringpath = implode(',', $path);
            $trip->image = $stringpath;
        }

        $trip->save();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':

                return redirect()->intended('admin/usertrip')->with('success','Ads Edited.');
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
        $trip = UserTrip::find($id);

        $imagearray = explode(',', $trip->image);
        foreach ($imagearray as $image) {
            File::delete($image);
        }
        
        File::delete($trip->itinerary);

        $trip->delete();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':

                return redirect()->intended('admin/usertrip')->with('success','Ads Removed.');
                break;
            
            default:
                return redirect()->intended('/')->with('success','Ads Removed.');
                break;
        }
    }
}