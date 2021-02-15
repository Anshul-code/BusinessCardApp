<?php

namespace App\Http\Controllers;

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



}
