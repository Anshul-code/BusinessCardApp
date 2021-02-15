<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function getEducationData(Request $request){
        if ($request->ajax()) {
            $data = Education::where('user_id', Auth::user()->id)->get();     
            return datatables()->of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){

                            $btn = '
                                    <button class="btn btn-danger btn-sm delete" id="'. $row->id .'" data-toggle="modal" data-target="#confirmModal"><span class="fas fa-trash-alt"></span></button>
                                   ';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }
    
    //delete selected education
    public function deleteEducationData($id){
        $edu = Education::findOrFail($id);
        $edu->delete();
    }

    public function newEducation(Request $request){
        $this->validate($request, [
            'institute' => 'required|min:2|max:255',
            'course' => 'required|min:2|max:255',
            'start_date' => 'required|date_format:Y-m-d|before:'.$request->end_date.'|before:'.date('Y-m-d'),
            'end_date' => 'required|date_format:Y-m-d|after:'.$request->start_date.'|before:'.date('Y-m-d'),
            'about_course' => 'required|min:8|max:200'
        ]);

        $edu = new Education;
        $edu->user_id = Auth::user()->id;
        $edu->institute = $request->institute;
        $edu->course = $request->course;
        $edu->start_date = $request->start_date;
        $edu->end_date = $request->end_date;
        $edu->about_course = $request->about_course;

        $edu->save();

        return redirect('addEducation')->with('success', ' Education Record Added');
        

    }
}
