<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;

class ContactController extends Controller
{
    //save contact message
    public function contactUser(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if(isset($id)){
            $mes = new Contact;
            $mes->user_id = $id;
            $mes->name = $request->name;
            $mes->email = $request->email;
            $mes->subject = $request->subject;
            $mes->message = $request->message;
            $mes->is_deleted = 'false';

            $mes->save();

            $user = User::where('id',$id)->first();
            return redirect('/'.$user->name_slug)->with('success', 'Message has been send');
        }
    }

    
    //mark message delete
    public function deleteContactMessages($id){
        $message = Contact::where('id',$id)->where('user_id', Auth::user()->id)->first();
        $message->is_deleted = 'true';
        $message->save();
    }

    //get deleted messages
    public function getDeletedContactMessages(Request $request){
        if($request->ajax()){
            $data = Contact::where('user_id', Auth::user()->id)->where('is_deleted', 'true')->get();
            return datatables()->of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){

                            $btn = '
                                    <button class="btn btn-danger btn-sm delete" id="'. $row->id .'" data-toggle="modal" data-target="#confirmModal"><span class="fas fa-trash-alt"></span></button>
                                    <button class="btn btn-primary btn-sm put" id="'. $row->id .'" data-toggle="modal" data-target="#confirmRetrieve"><span class="fas fa-trash-restore"></span></button>
                                   
                                    ';
     
                            return $btn;
                    })
                    ->editColumn('created_at', function($row){
                        return date('F j,Y (H:i)', strtotime($row->created_at));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    //delete message permanently
    public function deleteMessagesPermanently($id){
        $mes = Contact::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $mes->delete();
    }

    //restore messages
    public function retrieveMessage($id){
        $mes = Contact::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $mes->is_deleted = 'false';
        $mes->save();
    }


}
