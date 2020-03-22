<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agency;
use App\Facility;
use File;
use Image;

class ManageController extends Controller
{
    public function showAgencyList()
    {
        $agencies =  Agency::all();

    	return view('admin/manage/agency',compact('agencies'));
    }

    public function showFacilityList()
    {
        $facilities = Facility::all();

    	return view('admin/manage/facility',compact('facilities'));
    }

    public function storeFacility(Request $request)
    {
    	$facility = new Facility;

    	$facility->name = $request->input('name');

    	$facility->save();

    	return redirect()->intended('admin/manage/facility')->with('success','Facility Added.');
    }

    public function storeAgency(Request $request)
    {
    	$request->validate([
    		'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
    	]);

    	$agency = new Agency;

    	$agency->name = $request->input('name');

    	if ($request->hasFile('image')) {
            $avatar = $request->file('image');

            $dir_img = true;

            if( ! File::exists('images/agency_logo/')) {
                $dir_img = File::makeDirectory('images/agency_logo/', 0777, true);
            }

            $filename = rand(1111,9999).time().'.'.$avatar->getClientOriginalExtension();
            $image_path = 'images/agency_logo/'.$filename;

            Image::make($avatar)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);

        	$agency->image = $image_path;
        }

    	$agency->save();

    	return redirect()->intended('admin/manage/agency')->with('success','Agency Added.');
    }

    public function deleteFacility($id)
    {
        $facility = Facility::find($id);

        $facility->delete();

        return redirect()->intended('admin/manage/facility')->with('success','Facility Removed.');
    }

    public function deleteAgency($id)
    {
        $agency = Agency::find($id);

        $image = $agency->image;

        File::delete($image);

        $agency->delete();

        return redirect()->intended('admin/manage/agency')->with('success','Agency Removed.');
    }
}
