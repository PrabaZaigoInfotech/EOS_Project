<?php

namespace App\Http\Controllers\Backend\Badges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Badges\Badge;
use App\Models\User;
use App\Models\userProfile;
use Carbon\Carbon;
use App\Http\Requests\Backend\Badges\BadgeRequest;
use App\Http\Requests\CertificateCreateRequest;
use App\Models\Backend\Courses\Course;
use Illuminate\Support\Str;
use App\Events\ImageUrl;
use App\Models\AssignCertificate;
use App\Models\institution;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class BadgeController extends Controller
{
    public function index($id) {
        $entriesPerPage = setting('entries_per_page');
        $badges = Badge::where('user_id',$id)->with('course')->get();

       
        //dd($badges);
        // dd($badges);
        // $courses = Course::with('badges')->whereIn('course_name',$badges);
        // dd($courses->get());
        // $courses = $courses->whereHas('badges', function ($query) {
        //     $query->where('user_id', auth()->user()->id);
        // });
        // $courses = $courses->get();
        //dd($courses);
        return view('backend.badges.index',compact('badges'));
    }
    public function create() {
        return view('backend.badges.create');
    }
    public function store(BadgeRequest $request) {
        $badge = new Badge;
        $badge->user_id = $request->user_id;
        $badge->course_name = $request->course_name;
        $badge->course_id = $request->course_id;
        $badge->date_completion = date('Y-m-d', strtotime($request->date_completion));
        $badge->status = 1;
        $course = Course::where('course_name',$request->course_name)->first();
        $imageUrl1=hash('sha256', asset('storage/images_uploads').'/'.$course->badge);
        $imageUrlEmail = asset('storage/images_uploads').'/'.$course->badge;
        $first_name = User::find($request->user_id)->userProfile()->first();
        $namefl=$first_name->first_name.' '.$first_name->last_name;
        if (isset($course)) {
            $userDate = ['user_id' => $namefl, 'badge' =>$imageUrl1,  'course_name' => $request->course_name, 'course_id' => $request->course_id, 'date_completion' => date('Y-m-d', strtotime($request->date_completion))];
        }
        $badge->json_values = json_encode($userDate);
        $badge->reference_id = Str::random(10).'-'. uniqid();
        $badge->save();
        if (isset($course)) {
            $user = User::with('userProfile')->find($request->user_id);
			event(new ImageUrl($imageUrlEmail,$user,$badge));
        }
        if (isset($course)) {
            return response()->json(['user_details' => $badge]);
		    //return redirect()->route('admin.badges.index')->withSuccess('Badge successfully created.');
        } else {
		    return redirect()->route('admin.badges.index')->withSuccess('Required course not available not created');
        }
    }
    public function show($id) {
        // dd('hhi');
        $badges = Badge::with('course')->find($id);
        $badgeDate = date('d/m/Y', strtotime($badges->date_completion));
        return response()->json(['message' => $badges,'badgeDate' =>$badgeDate ]);
    }
    public function destroy($user,$id) {
        $badge = Badge::find($id);
        $badge->delete();
        return redirect()->route('admin.badges.index',$user)->withSuccess('Badge successfully deleted.');
    }
    // public function list() {
    //     $entriesPerPage = setting('entries_per_page');
    //     $courses = Course::orderBy('id','desc')->paginate($entriesPerPage);
    // }
    public function nftStore(Request $request,$id) {
        $badge = Badge::where('id',$id)->update(['nft_value' => $request->nft]);
        return response()->json(['message' => 'success']);
    }
    public function imageUrl($id) {
        $badge = Badge::with('course','user.userProfile')->where('id',$id)->first();
        return view('backend.badges.image',compact('badge'));
    }


    public function assign_index($id)
    {
        $entriesPerPage = setting('entries_per_page');
        $assign_certificates=AssignCertificate::where('user_id',$id)->get();
        return view('backend.badges.assigncertificate.index',compact('assign_certificates'));
    }
    public function assign_create(Request $request)
    {
        $institution = Institution::all();

    return view('backend.badges.assigncertificate.create',compact('institution'));
    }

    public function assign_store(CertificateCreateRequest $request,$id)
    {

        $badges = Badge::where('user_id',$id)->with('course')->get();
        $assign_certificates=AssignCertificate::where('user_id',$id)->get();

        $assign_certificate=new AssignCertificate;
        $assign_certificate->user_id = $id;
        $assign_certificate->institution_name=$request->institution_name;
        $assign_certificate->course_name = $request->course_name;
        $assign_certificate->total_hours = $request->total_hours;
        $assign_certificate->date_completion = date('Y-m-d', strtotime($request->date_completion));
        $assign_certificate->save();

        return view('backend.badges.assigncertificate.index',compact('badges','assign_certificates'));
    }

public function assign_show($id)
{
    $assign_certificate = AssignCertificate::find($id);
    return response()->json(['messages' => $assign_certificate ]);

}

public function image($id) {
    $assign_certificate = AssignCertificate::find($id);
    return view('backend.badges.image',compact('assign_certificate'));
}
   
}