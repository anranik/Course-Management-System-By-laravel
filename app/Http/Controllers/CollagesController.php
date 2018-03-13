<?php

namespace App\Http\Controllers;

use App\Collages;
use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CollagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Collages::all();
        return view('admin.collages.index',compact('data'));
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



        return view('admin.collages.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $collage = new Collages();

        $collage->name = $request->get('name');
        $collage->instructorId = $request->get('instructor');

        $collage->save();
        \Session::flash('msg', 'College Added Successfully.' );
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\collages  $collages
     * @return \Illuminate\Http\Response
     */
    public function show(collages $collages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\collages  $collages
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $collage = Collages::findOrFail($id);
        $users = User::whereHas('roles', function($q)
        {
            $q->where('name', 'Instructor');
        })->get();

        return view('admin.collages.edit',compact('collage','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\collages  $collages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $collage = Collages::findOrFail($id);

        $collage->update($request->all());
        \Session::flash('msg', 'College updated Successfully.' );
        return redirect()->action('CollagesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\collages  $collages
     * @return \Illuminate\Http\Response
     */
    public function destroy(collages $collages)
    {
        //
    }
}
