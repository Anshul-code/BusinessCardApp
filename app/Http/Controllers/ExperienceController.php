<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    
    public function getExperienceData(Request $request){
        if ($request->ajax()) {
            $data = Experience::where('user_id', Auth::user()->id)->get();     
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
    
    //delete selected experience
    public function deleteExperienceData($id){
        $exp = Experience::findOrFail($id);
        $exp->delete();
    }

    public function newExperience(Request $request){
        $this->validate($request, [
            'company' => 'required|min:2|max:255',
            'title' => 'required|min:4|max:255',
            'start_date' => 'required|date_format:Y-m-d|before:'.$request->end_date.'|before:'.date('Y-m-d'),
            'end_date' => 'required|date_format:Y-m-d|after:'.$request->start_date.'|before:'.date('Y-m-d'),
            'about_exp' => 'required|min:8|max:200'
        ]);

        $exp = new Experience;
        $exp->user_id = Auth::user()->id;
        $exp->company = $request->company;
        $exp->title = $request->title;
        $exp->start_date = $request->start_date;
        $exp->end_date = $request->end_date;
        $exp->about_exp = $request->about_exp;

        $exp->save();

        return redirect('addExperience')->with('success', ' Experience Added');
        

    }


}
