<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Year;
use App\Semester;
use Illuminate\Support\Facades\Validator;

class YearController extends Controller
{
    public function index(){
        $years = Year::all();
        $semesters = Semester::all();

        return view('admin.years.index',compact('years','semesters'));
    }


    /**
     * Store semester
     */

    public function addSemester(Request $request){

        //$q = Semester::where('isCurrent',1)->orderBy('updated_at','desc')->first();




        $validator = Validator::make($request->all(), [
            'semester' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {

            $semester = new Semester();



            $semester->semester = $request->input('semester');

            if ( $request->has('current') == 1){

                $all = Semester::all();
                foreach ($all as $a){
                    $a->isCurrent = 0;
                    $a->save();
                }
                $semester->isCurrent = $request->input('current');
            }

            $semester->save();
            \Session::flash('msg', 'Semester Added successfully');
            return redirect()->action('YearController@index');

        }

    }

    /**
     * delete a semester
     */
    public function deleteSemester($id){
       Semester::destroy($id);
        \Session::flash('msg', 'Semester deleted successfully');
        return redirect()->action('YearController@index');
    }

    /**
     * Store semester
     */

    public function addYear(Request $request){


        $validator = Validator::make($request->all(), [
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {

            $semester = new Year();

            $semester->year = $request->input('year');
            if ( $request->has('current') == 1){

                $all = Year::all();
                foreach ($all as $a){
                    $a->isCurrent = 0;
                    $a->save();
                }
                $semester->isCurrent = $request->input('current');
            }

            $semester->save();
            \Session::flash('msg', 'Year Added successfully');
            return redirect()->action('YearController@index');

        }

    }

    /**
     * edit a year
     */
    public function editYear($id){
      $data =  Year::where('id',$id)->get();
      return view('admin.years.editYear',compact('data'));
    }
    /**
     * update a year
     */
    public function updateYear(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {

            $semester = Year::find($id);


            $semester->year = $request->input('year');
            if ( $request->has('current') == 1){

                $all = Year::all();
                foreach ($all as $a){
                    $a->isCurrent = 0;
                    $a->save();
                }
                $semester->isCurrent = $request->input('current');
            }

            $semester->save();
            \Session::flash('msg', 'Year Updated successfully');
            return redirect()->action('YearController@index');

        }



    }
    /**
     * edit a semester
     */
    public function editSemester($id){
      $data =  Semester::where('id',$id)->get();
      return view('admin.years.editSemester',compact('data'));
    }
    /**
     * update a semester
     */
    public function updateSemester(Request $request,$id){


        $validator = Validator::make($request->all(), [
            'semester' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else {

            $semester = Semester::find($id);


            $semester->semester = $request->input('semester');
            if ( $request->has('current') == 1){

                $all = Semester::all();
                foreach ($all as $a){
                    $a->isCurrent = 0;
                    $a->save();
                }
                $semester->isCurrent = $request->input('current');
            }

            $semester->save();
            \Session::flash('msg', 'Semester Updated successfully');
            return redirect()->action('YearController@index');

        }



    }
    /**
     * delete a semester
     */
    public function deleteYear($id){
       Year::destroy($id);
        \Session::flash('msg', 'Year deleted successfully');
        return redirect()->action('YearController@index');
    }
}
