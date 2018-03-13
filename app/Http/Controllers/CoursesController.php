<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Department;
use App\Collages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Courses::all();

        return view('admin.courses.index', compact('data'));
    }

    public function test(){

        $data = Courses::find(5)->get();

        foreach ($data as $col){
            echo $col->collage;
        }


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $collages = Collages::all();
        return view('admin.courses.create',compact('collages','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'courseID' => 'required',
            'departmentName' => 'required',
            'collageName' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {

            $collage = new Courses();

            $collage->name = $request->get('name');
            $collage->courseID = $request->get('courseID');
            $collage->departmentId = $request->get('departmentName');
            $collage->collageId = $request->get('collageName');

            $collage->save();
            \Session::flash('msg', 'Course Added Successfully.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function show(Courses $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function edit(Courses $courses, $id)

    {

        $collages = Collages::all();
        $departments = Department::all();
        $course = Courses::findOrFail($id);

        return view('admin.courses.edit',compact('course','collages','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courses $courses, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'departmentName' => 'required',
            'collageName' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {

            $collage = Courses::findOrFail($id);

            $collage->name = $request->get('name');
            $collage->departmentId = $request->get('departmentName');
            $collage->collageId = $request->get('collageName');

            $collage->update();
            \Session::flash('msg', 'Course updated Successfully.');
            return redirect('/admin/courses');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courses $courses)
    {
        //
    }
}
