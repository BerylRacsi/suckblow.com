<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Course;
use App\Agency;
use File;
use Image;
use Alert;

class CourseController extends Controller
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
            'agency' => ['required'],
            'diver' => ['required','string', 'max:30'],
            'center' => ['required','string', 'max:30'],

            'open' => ['boolean'],
            'advance' => ['boolean'],
            'rescue' => ['boolean'],
            'master' => ['boolean'],
            'instructor' => ['boolean'],

            'total' => ['required','numeric','max:35000','min:1'],
            'since' => ['required','numeric','max:2020','min:1900'],

            'fb' => ['required', 'string', 'max:50'],
            'ig' => ['required', 'string', 'max:50'],

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
        $courses = Course::all();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/course/index',compact('courses'));
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

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/course/create',compact('agencies'));
                break;
            
            default:
                return view('welcome');
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

        $course = new Course;
        $course->name = $request->input('name');
        $course->agency = $request->input('agency');
        $course->diver = $request->input('diver');
        $course->center = $request->input('center');
        $course->open = $request->has('qual1');
        $course->advance = $request->has('qual2');
        $course->rescue = $request->has('qual3');
        $course->master = $request->has('qual4');
        $course->instructor = $request->has('qual5');
        $course->total = $request->input('total');
        $course->since = $request->input('since');
        $course->ig = $request->input('ig');
        $course->fb = $request->input('fb');

        if ($request->hasFile('image')) {
            $avatar = $request->file('image');

            $dir_img = true;

            if( ! File::exists('images/diver_avatar/')) {
                $dir_img = File::makeDirectory('images/diver_avatar/', 0777, true);
            }

            //validation
            $name = $avatar->getClientOriginalName();

            if (!in_array($avatar->getClientOriginalExtension(), array('jpg','png','jpeg'))) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$name.', only JPG, PNG, and JPEG are allowed.');
            }

            if ($avatar->getSize() > 1000000) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$name.', maximum allowed image size is 1 MB.');
            }

            $filename = rand(1111,9999).time().'.'.$avatar->getClientOriginalExtension();
            $image_path = 'images/diver_avatar/'.$filename;

            Image::make($avatar)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);
            
            $course->image = $image_path;
        }

        else {
            return back()
                ->withInput($request->all())
                ->withErrors('You need to upload an image.');
        }

        $course->save();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':

                return redirect()->intended('admin/course')->with('success','Ads Submitted.');
                break;
            
            default:
                return redirect()->intended('/')->with('success','Ads Submitted.');
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
        $course = Course::find($id);

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/course/detail',compact('course'));
                break;
            
            default:
                return view('welcome');
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
        $course = Course::find($id);
        $agencies = Agency::all();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':
                return view('admin/advertisement/course/edit',compact('course','agencies'));
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
        $this->Validator($request->all())->validate();

        $course = Course::find($id);
        $course->name = $request->input('name');
        $course->agency = $request->input('agency');
        $course->diver = $request->input('diver');
        $course->center = $request->input('center');
        $course->open = $request->has('qual1');
        $course->advance = $request->has('qual2');
        $course->rescue = $request->has('qual3');
        $course->master = $request->has('qual4');
        $course->instructor = $request->has('qual5');
        $course->total = $request->input('total');
        $course->since = $request->input('since');
        $course->ig = $request->input('ig');
        $course->fb = $request->input('fb');

        if ($request->hasFile('image')) {

            $image = $course->image;
            File::delete($image);

            $avatar = $request->file('image');

            //validation
            $name = $avatar->getClientOriginalName();

            if (!in_array($avatar->getClientOriginalExtension(), array('jpg','png','jpeg'))) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$name.', only JPG, PNG, and JPEG are allowed.');
            }

            if ($avatar->getSize() > 1000000) {
                return back()
                    ->withInput($request->all())
                    ->withErrors('Failed to upload image : '.$name.', maximum allowed image size is 1 MB.');
            }

            $filename = rand(1111,9999).time().'.'.$avatar->getClientOriginalExtension();
            $image_path = 'images/diver_avatar/'.$filename;

            Image::make($avatar)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);

            $course->image = $image_path;
        }

        $course->save();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':

                return redirect()->intended('admin/course')->with('success','Ads Edited.');
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
        $course = Course::find($id);
        $image = $course->image;

        File::delete($image);
        
        $course->delete();

        $role = $this->guardCheck();

        switch ($role) {
            case 'admin':

                return redirect()->intended('admin/course')->with('success','Ads Removed.');
                break;
            
            default:
                return redirect()->intended('/')->with('success','Ads Removed.');
                break;
        }
    }
}
