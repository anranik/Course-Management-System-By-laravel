<?php

namespace App\Http\Controllers;

use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Workshop::all();
        return view('admin.workshop.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.workshop.create');

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
            'locationBuilding' => 'required',
            'locationRoom' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {

            $workshop = new Workshop();

            $workshop->title = $request->get('title');
            $workshop->language = $request->get('language');
            $workshop->oneDay = $request->get('oneDay');
            $workshop->dateFrom = $request->get('dateFrom');
            $workshop->dateTo = $request->get('dateTo');
            $workshop->locationBuilding = $request->get('locationBuilding');
            $workshop->locationRoom = $request->get('locationRoom');
            $workshop->city = $request->get('city');
            $workshop->maxSeat = $request->get('maxSeat');
            $workshop->coffeBreak = $request->get('coffeBreak');
            $workshop->invitationTo = $request->get('invitationTo');

            $workshop->save();
            \Session::flash('msg', 'Workshop Added Successfully.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop,$id)
    {
        $data = Workshop::where('id',$id)->get();
        return view('admin.workshop.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop, $id)
    {
        $data = Workshop::where('id',$id)->get();
        return view('admin.workshop.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop,$id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {

            $workshop = Workshop::findOrFail($id);

            $workshop->title = $request->get('title');
            $workshop->language = $request->get('language');
            $workshop->oneDay = $request->get('oneDay');
            $workshop->dateFrom = $request->get('dateFrom');
            $workshop->dateTo = $request->get('dateTo');
            $workshop->locationBuilding = $request->get('locationBuilding');
            $workshop->locationRoom = $request->get('locationRoom');
            $workshop->city = $request->get('city');
            $workshop->maxSeat = $request->get('maxSeat');
            $workshop->coffeBreak = $request->get('coffeBreak');
            $workshop->invitationTo = $request->get('invitationTo');
            $workshop->update();




            \Session::flash('msg', 'Workshop updated successfully.');
            return redirect(route('admin.AllWorkshops'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        //
    }
}
