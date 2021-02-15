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
use Yajra\DataTables\Facades\DataTables;

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
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a class="btn btn-primary btn-sm edit" href="/showUsers/editUser/'. $row->id .'" ><span class="fas fa-edit"></span></a>
                                    <a class="btn btn-dark btn-sm edit" href="/'. $row->name_slug .'" target="_blank"><span class="fas fa-eye"></span></a>
                                    ';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }
    
    //edit users profile
    public function editUsers($id){
        
        $skill = Skill::where('user_id', $id)->get();
        $images = Portfolio::where('user_id', $id)->get();
        $user = User::where('id', $id)->where('role', 'user')->first();
        return view('pages.admin.editUserProfile')->with([
            'skill' => $skill,
            'images' => $images,
            'user_data'=> $user 
        ]);
    }

    //change users profile template
    public function updateTemplateAdminEdit($id){
        $temp = AdditionalInfo::select('template')->where('user_id', $id)->first();
        $user = User::where('id', $id)->where('role', 'user')->first();
        return view('pages.admin.updateTemplateAdminEdit')->with(['temp' => $temp, 'user_data' => $user]);
    }


    //user's portfolio
    public function portfolioAdminEdit($id){
        $skills = Skill::where('user_id', $id)->get();
        $user = User::where('id', $id)->where('role', 'user')->first();
        return view('pages.admin.portfolio')->with(['skills' => $skills, 'user_data' => $user]);
    }    


}
