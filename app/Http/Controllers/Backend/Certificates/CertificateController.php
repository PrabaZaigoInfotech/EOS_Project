<?php

namespace App\Http\Controllers\Backend\Certificates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Models\Backend\Courses\Course;
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

    public function create1() {
        
        // $institution = Institution::get('institution_name');

         $institution= Institution::all();
        
        
        // dd($search);
        
        $data=Institution::all();
      
   
        return view('backend.certificates.create1',compact('institution','data'));
    }
    public function store(CourseRequest $request) {
        //dd($request->all());
        //$data=$request->all();
        //$image=$request->canimgbs;

        $fileExtension =  $request->file_upload->extension();
		$timeStamp = Carbon::now()->format('Y_m_d_H_i_s_u');
		$fileName = $timeStamp.'.'.$fileExtension;	    
		$request->file_upload->storeAs('public/images_uploads', $fileName);
        //$folderPath = "{{asset('images/')}}";
        // $folderPath = public_path('images_uploads');
        // $image = str_replace('data:image/png;base64,', '', $image);
        // $image = str_replace(' ', '+', $image);
        // $imageName = uniqid().'.'.'png';
        // $fileName = $folderPath . $imageName;
        /*       $image_parts = explode(";base64,", $canimgbg);
        $image_type_aux = explode("data:image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = storage_path(uniqid() . '.'.$image_type) ;*/
        //File::put(storage_path(). '/' . $imageName, base64_decode($image));
        //file_put_contents(public_path('images_uploads'). '/' . $imageName, base64_decode($image)); 
        //dd($image);
           $course = new Course;
           $course->course_name = $request->course_name;
           $course->description = $request->description;
           $course->badge = $fileName;
           $course->save();
           return redirect()->route('admin.courses.index');
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
