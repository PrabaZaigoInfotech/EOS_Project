<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Courses\Course;

class CourseController extends Controller
{
    public function create() {
      return view('backend.courses.create');  
    }
    public function store(Request $request) {
        $course = new Course;
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->save();
        return redirect()->route('admin.certificates.create');
    }
    public function index() {
        $entriesPerPage = setting('entries_per_page');
        $courses = Course::orderBy('id','desc')->paginate(12);
        return view('backend.courses.index',compact('courses')); 
    }
    
}
