<?php

namespace App\Http\Controllers;

use App\CourseRequest;
use App\HelpDesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HelpDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = HelpDesk::where('userId',\Auth::id())->get();

        $randomQuestion = HelpDesk::inRandomOrder()->take(5);
        return view('instructor.helpdesk.index',compact('questions','randomQuestion'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = CourseRequest::all();
        $inscourse = CourseRequest::where('instructorId',\Auth::id())->get();
        return view('instructor.helpdesk.create',compact('data','inscourse'));
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
            'title' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {

            $collage = new HelpDesk();

            $collage->title = $request->input('title');
            $collage->message = $request->input('message');
            $collage->courseId = $request->input('courseId');
            $collage->userId = \Auth::id();


            //file
            if ($request->file('attachment') != NULL){
            $image = $request->file('attachment');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/helpdesk/images');
            $image->move($destinationPath, $input['imagename']);
            $collage->attachment = $input['imagename'];
        }

            //file
            $collage->save();
            \Session::flash('msg', 'Request send Successfully.');
            return redirect()->action('HelpDeskController@index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HelpDesk  $helpDesk
     * @return \Illuminate\Http\Response
     */
    public function show(HelpDesk $helpDesk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HelpDesk  $helpDesk
     * @return \Illuminate\Http\Response
     */
    public function edit(HelpDesk $helpDesk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HelpDesk  $helpDesk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HelpDesk $helpDesk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HelpDesk  $helpDesk
     * @return \Illuminate\Http\Response
     */
    public function destroy(HelpDesk $helpDesk)
    {
        //
    }


    /**
     * administrator help desk
     */
    public function adminHelpDesk(){
        $questions = HelpDesk::all();
        return view('admin.helpdesk.index',compact('questions'));
    }

    /**
     * Display the specified resource to admin.
     *
     * @param  \App\HelpDesk  $helpDesk
     * @return \Illuminate\Http\Response
     */
    public function adminHelpView($id)
    {
        $question = HelpDesk::where('id',$id)->get();

        return view('admin.helpdesk.show',compact('question'));
    }
}
