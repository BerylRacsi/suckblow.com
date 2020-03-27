<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\PartnerTrip;
use App\Agency;
use App\Facility;
use File;
use Image;
use Alert;

class PartnerTripController extends Controller
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
            'address' => ['required', 'string', 'max:100'],
            'since' => ['required','numeric','max:2020','min:1900'],

            'logo.*' => 'image',
            'image.*' => 'image',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = PartnerTrip::all();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/partnertrip/index',compact('trips'));
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
        $agencies = Agency::all();
        $facilities = Facility::all();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/partnertrip/create',compact('agencies','facilities'));
                break;
            
            default:
                return view('main/trip/create-partner',compact('agencies','facilities'));
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

        $trip = new PartnerTrip;
        $trip->name = $request->input('name');
        $trip->description = $request->input('description');
        $trip->price = $request->input('price');
        $trip->location = $request->input('location');
        $trip->address = $request->input('address');
        $trip->since = $request->input('since');

        if ($request->has('agency')) {
            $trip->agency = implode(',', $request->input('agency'));
        }
        else{
            $trip->agency =  'Not related to any registered agencies.';
        }

        if ($request->has('facility')) {
            $trip->facility = implode(',', $request->input('facility'));
        }
        else{
            $trip->facility =  'None';
        }

        if ($request->hasFile('logo') && $request->hasFile('image')) {

            //logo
            $logo = $request->file('logo');

            $dir_img = true;

            if( ! File::exists('images/company_logo/')) {
                $dir_img = File::makeDirectory('images/company_logo/', 0777, true);
            }

            //images
            $images = $request->file('image');
 
            $org_img = true;

            $path = [];
 
            if( ! File::exists('images/partner_trip_photos/')) {
                $org_img = File::makeDirectory('images/partner_trip_photos/', 0777, true);
            }

            //validationLogo
            $nameLogo = $logo->getClientOriginalName();

            if (!in_array($logo->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameLogo.', only JPG, PNG, and JPEG are allowed.');
            }

            if ($logo->getSize() > 1000000) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameLogo.', maximum allowed image size is 1 MB.');
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

            // logo
            $filenameLogo = rand(1111,9999).time().'.'.$logo->getClientOriginalExtension();
            $image_path = 'images/company_logo/'.$filenameLogo;

            Image::make($logo)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);
            
            $trip->logo = $image_path;

            // Images
            foreach($images as $key => $image) {
                
                //get file name of image  and concatenate with 4 random integer for unique
                $filenameImages = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

                //path of image for upload
                $org_path = 'images/partner_trip_photos/' . $filenameImages;

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

        else if(!$request->hasFile('logo')){
            return back()
                ->withInput($request->all())
                ->withErrors('You need to upload an image for logo.');
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

                return redirect()->intended('admin/partnertrip')->with('success','Ads Submitted.');
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
        $trip = PartnerTrip::find($id);
        $agencies = Agency::all();
        $facilities = Facility::all();

        $agencyArray = [];
        $facilitiesArray = [];

        foreach ($agencies as $key => $agency) {
            foreach (explode(',', $trip->agency) as $checked) {
                if ($agency->name === $checked) {
                    $agencyArray[$key] = 'checked'; 

                    continue 2;
                }
            }
            $agencyArray[$key] = NULL;
        }

        foreach ($facilities as $key => $facility) {
            foreach (explode(',', $trip->facility) as $checked) {
                if ($facility->name === $checked) {
                    $facilityArray[$key] = 'checked'; 

                    continue 2;
                }
            }
            $facilityArray[$key] = NULL;
        }

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/partnertrip/detail',compact('trip','agencies','facilities','agencyArray','facilityArray'));
                break;
            
            default:
                return view('main/trip/detail-partner',compact('trip','agencies','facilities','agencyArray','facilityArray'));
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
        $trip = PartnerTrip::find($id);
        $agencies = Agency::all();
        $facilities = Facility::all();

        $agencyArray = [];
        $facilitiesArray = [];

        foreach ($agencies as $key => $agency) {
            foreach (explode(',', $trip->agency) as $checked) {
                if ($agency->name === $checked) {
                    $agencyArray[$key] = 'checked'; 

                    continue 2;
                }
            }
            $agencyArray[$key] = NULL;
        }

        foreach ($facilities as $key => $facility) {
            foreach (explode(',', $trip->facility) as $checked) {
                if ($facility->name === $checked) {
                    $facilityArray[$key] = 'checked'; 

                    continue 2;
                }
            }
            $facilityArray[$key] = NULL;
        }

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/partnertrip/edit',compact('trip','agencies','facilities','agencyArray','facilityArray'));
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

        $trip = PartnerTrip::find($id);
        $trip->name = $request->input('name');
        $trip->description = $request->input('description');
        $trip->price = $request->input('price');
        $trip->location = $request->input('location');
        $trip->address = $request->input('address');
        $trip->since = $request->input('since');

        if ($request->has('agency')) {
            $trip->agency = implode(',', $request->input('agency'));
        }
        else{
            $trip->agency =  'Not related to any registered agencies.';
        }

        if ($request->has('facility')) {
            $trip->facility = implode(',', $request->input('facility'));
        }
        else{
            $trip->facility =  'None';
        }

        if ($request->hasFile('logo') && $request->hasFile('image')) {

            //logo
            $logo = $request->file('logo');

            $dir_img = true;

            if( ! File::exists('images/company_logo/')) {
                $dir_img = File::makeDirectory('images/company_logo/', 0777, true);
            }

            //images
            $images = $request->file('image');
 
            $org_img = true;

            $path = [];
 
            if( ! File::exists('images/partner_trip_photos/')) {
                $org_img = File::makeDirectory('images/partner_trip_photos/', 0777, true);
            }

            //validationLogo
            $nameLogo = $logo->getClientOriginalName();

            if (!in_array($logo->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameLogo.', only JPG, PNG, and JPEG are allowed.');
            }

            if ($logo->getSize() > 1000000) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameLogo.', maximum allowed image size is 1 MB.');
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

            // logo
            $filenameLogo = rand(1111,9999).time().'.'.$logo->getClientOriginalExtension();
            $image_path = 'images/company_logo/'.$filenameLogo;

            Image::make($logo)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);
            
            $trip->logo = $image_path;

            // Images
            foreach($images as $key => $image) {
                
                //get file name of image  and concatenate with 4 random integer for unique
                $filenameImages = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

                //path of image for upload
                $org_path = 'images/partner_trip_photos/' . $filenameImages;

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
        else if($request->hasfile('logo')) {
            //logo old delete
            $logoOld = $trip->logo;
            File::delete($logoOld);

            //logo
            $logo = $request->file('logo');

            $dir_img = true;

            if( ! File::exists('images/company_logo/')) {
                $dir_img = File::makeDirectory('images/company_logo/', 0777, true);
            }

            //validationLogo
            $nameLogo = $logo->getClientOriginalName();

            if (!in_array($logo->getClientOriginalExtension(), array('jpg','png','jpeg','JPG','PNG','JPEG'))) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameLogo.', only JPG, PNG, and JPEG are allowed.');
            }

            if ($logo->getSize() > 1000000) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$nameLogo.', maximum allowed image size is 1 MB.');
            }

            // logo
            $filenameLogo = rand(1111,9999).time().'.'.$logo->getClientOriginalExtension();
            $image_path = 'images/company_logo/'.$filenameLogo;

            Image::make($logo)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);
            
            $trip->logo = $image_path;
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
 
            if( ! File::exists('images/partner_trip_photos/')) {
                $org_img = File::makeDirectory('images/partner_trip_photos/', 0777, true);
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
                $org_path = 'images/partner_trip_photos/' . $filenameImages;

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

                return redirect()->intended('admin/partnertrip')->with('success','Ads Edited.');
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
        $trip = PartnerTrip::find($id);

        $imagearray = explode(',', $trip->image);
        foreach ($imagearray as $image) {
            File::delete($image);
        }
        
        File::delete($trip->logo);

        $trip->delete();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':

                return redirect()->intended('admin/partnertrip')->with('success','Ads Removed.');
                break;
            
            default:
                return redirect()->intended('/')->with('success','Ads Removed.');
                break;
        }
    }
}
