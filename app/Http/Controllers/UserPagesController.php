<?php

namespace App\Http\Controllers;

use App\DataTables\ContactDataTable as DataTablesContactDataTable;
use ContactDatatable;
use App\Models\AdditionalInfo;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Portfolio;
use App\Models\Reference;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserPagesController extends Controller
{
    public function dashboard(){
        $skill = Skill::where('user_id', Auth::user()->id)->get();
        $images = Portfolio::where('user_id', Auth::user()->id)->get();
        $messages = Contact::where('user_id',Auth::user()->id)->where('is_deleted', 'false')->get();
        return view('pages.user.dashboard')->with([
            'skill' => $skill,
            'images' => $images,
            'messages' => $messages
        ]);
    }

    public function viewProfile($name_slug){
    
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

    public function editUserProfile(){
        $data = User::where('id',Auth::user()->id)->first();
 
        return view('pages.user.editUserProfile')->with('data_user',$data);
    }

    public function editAdditionalInfo(){
        $info = AdditionalInfo::where('user_id', Auth::user()->id)->first();
        if($info != null){
            return view('pages.user.editAdditionalInfo')->with('info',$info);
        }

        return view('pages.user.editAdditionalInfo');   
    }

    public function updateProfileTemplate(){
        $temp = AdditionalInfo::select('template')->where('user_id', Auth::user()->id)->first();

        return view('pages.user.updateProfileTemplate')->with('temp', $temp);
    }

    public function addSkills(){
        $skills = Skill::where('user_id', Auth::user()->id)->get();
        return view('pages.user.addSkills')->with('skills', $skills);
    }

    public function changePassword(){
        return view('pages.user.changePassword');
    }

    public function editSkill($id){
        $skill_info = Skill::where('id',$id)->where('user_id', Auth::user()->id)->first();
        return view('pages.user.editSkill')->with('skill_info', $skill_info);
    }

    public function portfolio(){
        $skills = Skill::where('user_id', Auth::user()->id)->get();
        return view('pages.user.portfolio')->with(['skills' => $skills]);
    }

    //ajax request to get portfolio images for template - creative
    public function fetch_data(Request $request,$slug){
        if($request->ajax())
        {
        $user = User::where('name_slug',$slug)->first();
        $portfolio = Portfolio::where('user_id', $user->id)->paginate(2);
        return  view('pages.user.renderPortfolio')->with('portfolio',$portfolio)->render();
        }
    }

    //ajax request to get portfolio images for template - cresume
    public function fetch_data_cresume(Request $request,$slug){
        if($request->ajax())
        {
        $user = User::where('name_slug',$slug)->first();
        $portfolio = Portfolio::where('user_id', $user->id)->paginate(3);
        return  view('pages.user.renderPortfolioCresume')->with('portfolio',$portfolio)->render();
        }
    }

    //add Experience page
    public function addExperience(){
        return view('pages.user.addExperience');
    }

    //add Education page
    public function addEducation(){
        return view('pages.user.addEducation');
    }

    //add references page
    public function addReference(){
        return view('pages.user.addReference');
    }

   
    public function contactMessages(DataTablesContactDataTable $dataTable){
        return $dataTable->render('pages.user.contactMessages');
    }

   

    //get deleted messages
    public function contactDeletedMessages(){
        return view('pages.user.contactDeletedMessages');
    }
    


}
