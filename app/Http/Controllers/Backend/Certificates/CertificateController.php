<?php

namespace App\Http\Controllers\Backend\Certificates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Models\Backend\Courses\Course;
use App\Models\Certificate;
use Carbon\Carbon;
use App\Models\Institution;
use App\Http\Requests\Backend\Courses\CourseRequest;

use DB;



class CertificateController extends Controller
{
    public function index() {
        $images = \File::allFiles(public_path('images_uploads'));
        return view('backend.certificates.index')->with(array('images'=>$images));
    }
    public function create() {
        
        return view('backend.certificates.create');
    }

    public function create1(Request $request) {
        
        // $institution = Institution::get('institution_name');
        $institution= Institution::all();
        $role = $request->input('institution_name', null);
        $data= $institution= Institution::all();
        if($role)
        {
            $data = Institution::where('id',$role)->get();

        }
      
   
     return view('backend.certificates.create1',compact('institution','data'));
    }
    public function store(Request $request) {
        //dd($request->all());
      
     
        //dd($image);
           $course = new Certificate;
           $course->institution_id = $request->institution;
           $course->image_svg = $request->svg;
           $course->image_json = '';
           $course->save();

           return redirect()->route('admin.certificates.index');
        //response()->json([ 'message'=>'File uploaded' ]); 
        /*return redirect()->route('admin.certificates.index')->withSuccess('Certificates successfully created.');*/

    }
    public function edit($id) {
        $courses = Course::where('id',$id)->first();
        return view('backend.certificates.edit',compact('courses'));
    }
    public function update(CourseRequest $request,$id) {
        $course = Course::find($id);
        if($request->file_upload) {
            $fileExtension =  $request->file_upload->extension();
            $timeStamp = Carbon::now()->format('Y_m_d_H_i_s_u');
            $fileName = $timeStamp.'.'.$fileExtension;	    
            $request->file_upload->storeAs('public/images_uploads', $fileName);
            $course->badge = $fileName;
        }        
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->update();
        return redirect()->route('admin.courses.index');
    }
 

}
