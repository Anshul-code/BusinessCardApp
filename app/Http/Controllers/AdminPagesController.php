<?php

namespace App\Http\Controllers;

use App\Models\AdditionalInfo;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Portfolio;
use App\Models\Reference;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPagesController extends Controller
{
    //admin dashboard
    public function dashboard(){
        $user = User::where('role','user')->get();
        return view('pages.admin.dashboard')->with('user', $user);
    }

    //edit admin profile
    public function editAdminProfile(){
        $admin = User::where('id', Auth::user()->id)->where('role','admin')->first();
        return view('pages.admin.editAdminProfile')->with('data_admin', $admin);
    }

    //change admin password 
    public function editAdminPassword(){
        return view('pages.admin.editAdminPassword');
    }

    //show all users 
    public function showUsers(){
        return view('pages.admin.showUsers');
    }

    //get users data
    public function getUsersData(Request $request){
        if($request->ajax()){
            $data = User::where('role','user')->get();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a class="btn btn-primary btn-sm edit" href="/showUsers/editUser/'. $row->id .'" ><span class="fas fa-edit"></span></a>
                                    <a class="btn btn-dark btn-sm edit" href="/viewUserProfile/'. $row->name_slug .'" target="_blank"><span class="fas fa-eye"></span></a>
                                    ';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }
    
    //edit users profile
    public function editUsers(){
        return view('pages.admin.editUserProfile');
    }

    //view user's profile
    public function viewUserProfile($name_slug){
        
        $data = User::where('name_slug',$name_slug)->first();
        if($data != null){
            $addInfo = AdditionalInfo::where('user_id',$data->id)->first();
            $skillInfo = Skill::where('user_id', $data->id)->get();
            $portfolio = Portfolio::where('user_id',$data->id)->paginate(2);
            $portfolio_modal = Portfolio::where('user_id',$data->id)->get();
            $experience = Experience::where('user_id', $data->id)->get();
            $education = Education::where('user_id', $data->id)->get();
            $ref_data = Reference::where('user_id', $data->id)->get();

            if($addInfo != null && isset($addInfo->template)){
                if($addInfo->template == "cresume"){
                    $portfolio = Portfolio::where('user_id',$data->id)->paginate(3);
                    return view('pages.user.cresume')->with([
                        'data' => $data, 
                        'addInfo' => $addInfo,
                        'skill_info' => $skillInfo,
                        'portfolio' => $portfolio,
                        'portfolio_modal' => $portfolio_modal,
                        'exp_data' => $experience,
                        'edu_data' => $education,
                        'ref_data' => $ref_data,
                        ]);
                }
            }
            
            return view('pages.user.creative')->with([
                'data' => $data,
                'addInfo' => $addInfo,
                'skill_info' => $skillInfo,
                'portfolio' => $portfolio,
                'portfolio_modal' => $portfolio_modal,
                'exp_data' => $experience,
                'edu_data' => $education,
                'ref_data' => $ref_data,
            ]);
        }
        else{
            return redirect('/');
        }
    }


    


}
