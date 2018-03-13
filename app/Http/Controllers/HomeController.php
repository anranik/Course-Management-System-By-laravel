<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Courses;
use App\CourseRequest;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $courses_pending = CourseRequest::whereNull('builderId')->latest()->get();
        $courses_active = CourseRequest::whereNotNull('builderId')->latest()->get();
        return view('home',compact('courses_pending','courses_active'));

    }
}
