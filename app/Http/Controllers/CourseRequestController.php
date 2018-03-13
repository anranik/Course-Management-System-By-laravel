<?php

namespace App\Http\Controllers;
use App\Workshop;
use Illuminate\Support\Facades\Auth;
use App\CourseRequest;
use App\Courses;
use App\User;
use App\Year;
use App\Semester;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CourseRequest::all();

        return view('instructor.index',compact('data'));
    }

    /**
     * director dashborad
     */
    public function directorDashboard(){

        $data = CourseRequest::where('requestType','new')->get();
        $all_courses = CourseRequest::all();
        return view('director.dashboard',compact('data','all_courses'));

    }
    /**
     * director report generate
     */
    public function directorReport(){
        $courses = CourseRequest::all();
        return view('director.report', compact('courses'));
    }


    /**
     * director view course
     */
    public function viewCourseDirector($id){

        $data = CourseRequest::where('id',$id)->get();
        $instructors = User::whereHas('roles', function($q)
        {
            $q->where('name', 'Instructor');
        })->get();
        $assistance = User::whereHas('roles', function($q)
        {
            $q->where('name', 'assistance');
        })->get();
        $activeInsId = CourseRequest::where('id',$id)->pluck('otherInstructor')->toArray();
        $activeAsisId = CourseRequest::where('id',$id)->pluck('otherAssistance')->toArray();


        return view('director.course_view',compact('data','instructors','activeInsId','assistance','activeAsisId'));

    }

    /**
     * return instructor dashboard
     */

    public function instructorDashboard(){

        $user_id = Auth::id();
        //$events = Workshop::where('oneDay','yes')->get();
        //dd(Carbon::today()->toDateString());
        $events = Workshop::where('dateFrom','>',Carbon::today()->toDateString())->get();
        $data = CourseRequest::where('instructorId',$user_id)->get();

        $all = CourseRequest::all();




        //other instructor courses
        //$other_course = CourseRequest::find();
        //end other instructor courses


        return view('instructor.dashboard',compact('data','events','all'));



    }
    /**
     * return instructor report
     */

    public function instructorReport(){

        $user_id = Auth::id();
        $data = CourseRequest::where('instructorId',$user_id)->get();
        return view('instructor.report',compact('data'));
    }
    /**
     * return instructor dashboard
     */

    public function course_builderDashboard(){
        $data = CourseRequest::where('builderId',Auth::id())->where('status','pending')->get();
        $my_courses = CourseRequest::where('builderId',Auth::id())->get();

        return view('course_builder.dashboard',compact('data','my_courses'));



    } /**
     * return instructor dashboard
     */

    public function course_builderReport(){

        $data = CourseRequest::where('builderId',Auth::id())->get();
        return view('course_builder.report',compact('data'));



    }
    /**
     * return builder assign to page
     */

    public function assignCourseBuilder($id){


        $builders = User::whereHas('roles', function($q)
        {
            $q->where('name', 'Course Builder');
        })->get();
        $data = CourseRequest::where('id',$id)->get();


        return view('admin.assign',compact('data','builders'));

    }
    /**
     * return builder assign to form
     */

    public function assignCourseBuilderTo(Request $request,$id){



        if ($request->has('cancel')){

            $data = CourseRequest::findOrFail($id);
            $data->status = 'canceled';
            $data->save();
            \Session::flash('msg', 'Course has been canceled');
            return redirect()->action('HomeController@index');
        }else{
            $data = CourseRequest::findOrFail($id);
            $data->builderId = $request->builderId;
            $data->save();
            \Session::flash('msg', 'Course Assign to builder No: ' .$request->builderId);
            return redirect()->action('HomeController@index');
        }



    }
    /**
     * return builder assign to page
     */

    public function course_builderAssignTo($id){

        $data = CourseRequest::where('id',$id)->get();
        $instructors = User::whereHas('roles', function($q)
        {
            $q->where('name', 'Instructor');
        })->get();
        $assistance = User::whereHas('roles', function($q)
        {
            $q->where('name', 'assistance');
        })->get();
        $activeInsId = CourseRequest::where('id',$id)->pluck('otherInstructor')->toArray();
        $activeAsisId = CourseRequest::where('id',$id)->pluck('otherAssistance')->toArray();


        return view('course_builder.assign_course',compact('data','activeInsId','instructors','activeAsisId','assistance'));

    }
    /**
     * return builder assign to page
     */

    public function course_edit_instructor($id){
        $data = CourseRequest::where('id',$id)->get();
        $instructors = User::whereHas('roles', function($q)
        {
            $q->where('name', 'Instructor');
        })->get();
        $assistance = User::whereHas('roles', function($q)
        {
            $q->where('name', 'assistance');
        })->get();
        $activeInsId = CourseRequest::where('id',$id)->pluck('otherInstructor')->toArray();
        $activeAsisId = CourseRequest::where('id',$id)->pluck('otherAssistance')->toArray();
        return view('instructor.edit_request',compact('data','activeInsId','instructors','activeAsisId','assistance'));

    }
    /**
     * course reacivate
     */

    public function ecourseRequestReactive(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'courseId' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {


            $collage =  CourseRequest::findOrFail($id);
            $collage->totalSection = $request->input('totalSection');
            $collage->multiSection = $request->input('multiSection');
            $collage->otherInstructor = serialize($request->input('otherInstructor'));
            $collage->otherAssistance = serialize($request->input('otherAssistance'));
            $collage->remark = $request->input('remark');
            $collage->requestType = "reactivate";

            $collage->save();
            \Session::flash('msg', 'Course request reactivated successfully.');

            return redirect()->action('CourseRequestController@instructorDashboard');
        }
    }

    /**
     * admin report generate
     */
    public function adminReport(){
      $courses = CourseRequest::all();
      return view('admin.admin_report', compact('courses'));
    }

    /**
     * return activate
     */

    public function course_builderCourseActivate(Request $request){




        $validator = Validator::make($request->all(), [
            'year' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {

            $course = CourseRequest::findOrFail($request->input('id'));
            //$course->activated_by = Auth::id();
            $course->status = 'activated';
            $course->activated_at = \Carbon\Carbon::now();


            $course->save();
            \Session::flash('msg', 'Course request Activated successfully.');
            return redirect(route('admin.course_builderDashboard'));
        }



    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereHas('roles', function($q)
        {
            $q->where('name', 'Instructor');
        })->get();
        $assistance = User::whereHas('roles', function($q)
        {
            $q->where('name', 'assistance');
        })->get();
        $data = Courses::all();
        $years = Year::all();
        $semesters= Semester::all();
        return view('instructor.courseRequest',compact('data','users','assistance','years','semesters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CourseRequest $courseRequest)
    {

        $validator = Validator::make($request->all(), [
            'courseId' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {


            $collage = new CourseRequest();
            $collage->courseId = $request->input('courseId');
            $collage->instructorId = Auth::id();
            $collage->year = $request->input('year');
            $collage->semester = $request->input('semester');
            $collage->totalSection = $request->input('totalSection');
            $collage->multiSection = $request->input('multiSection');
            $collage->otherInstructor = serialize($request->input('otherInstructor'));
            $collage->otherAssistance = serialize($request->input('otherAssistance'));
            $collage->remark = $request->input('remark');


            $collage->save();
            \Session::flash('msg', 'Course request send successfully.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseRequest  $courseRequest
     * @return \Illuminate\Http\Response
     */
    public function show(CourseRequest $courseRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CourseRequest  $courseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseRequest $courseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseRequest  $courseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseRequest $courseRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseRequest  $courseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseRequest $courseRequest)
    {
        //
    }
}
