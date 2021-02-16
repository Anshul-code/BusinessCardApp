<?php

namespace App\Http\Controllers;

use App\Models\AdditionalInfo;
use App\Models\Portfolio;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function updateAdminProfile(Request $request){
        $user = User::find(Auth::user()->id);
        
        
        $slug = Str::slug($request->name);
        $data['name'] = $request->name;
        $data['name_slug'] = $slug;
        $data['email'] = $request->email;
        $data['phone_number'] = $request->phone_number;
        $data['address'] = $request->address;
        $data['dob'] = $request->dob;
    

        $name = $request->name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $dob = $request->dob;

      

        if($name == Auth::user()->name && $slug == Auth::user()->name_slug && $email == Auth::user()->email && $address == Auth::user()->address && $dob == Auth::user()->dob && $phone_number == Auth::user()->phone_number){
            return redirect('editAdminProfile')->with('warning'," Nothing to update");
        }
        else{
                if($name != Auth::user()->name && $email != Auth::user()->email){
                    $validator = Validator::make($data, [
                        'name' => ['required', 'string', 'min:3','max:255', 'unique:users,name','regex:/^[a-zA-Z\s]+$/'],
                        'name_slug' => ['unique:users,name_slug'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'address' => ['required','string','min:3','max:40'],
                        'dob' => ['required','date_format:Y-m-d','before:'.date('2012-01-01')],
                        'phone_number' => ['required','regex:/^[0-9]+$/','min:10','max:10']
                    ]);
                    if($validator->fails()){
                        return redirect('editAdminProfile')->withErrors($validator)->withInput();
                    }
                }
                if($name != Auth::user()->name && $email == Auth::user()->email){
                    $validator = Validator::make($data, [
                        'name' => ['required', 'string', 'min:3','max:255', 'unique:users,name','regex:/^[a-zA-Z\s]+$/'],
                        'name_slug' => ['unique:users,name_slug'],
                        'address' => ['required','string','min:3','max:40'],
                        'dob' => ['required','date_format:Y-m-d','before:'.date('2012-01-01')],
                        'phone_number' => ['required','regex:/^[0-9]+$/','min:10','max:10']
                    ]);
                    if($validator->fails()){
                        return redirect('editAdminProfile')->withErrors($validator)->withInput();
                    }
                }
                else if($name == Auth::user()->name && $email != Auth::user()->email){
                    $validator = Validator::make($data, [
                            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                            'address' => ['required','string','min:3','max:40'],
                            'dob' => ['required','date_format:Y-m-d','before:'.date('2012-01-01')],
                            'phone_number' => ['required','regex:/^[0-9]+$/','min:10','max:10']
                        ]);
                        if($validator->fails()){
                            return redirect('editAdminProfile')->withErrors($validator)->withInput();
                        }
                }
                else if($name == Auth::user()->name && $email == Auth::user()->email){
                    $validator = Validator::make($data, [
                            'address' => ['required','string','min:3','max:40'],
                            'dob' => ['required','date_format:Y-m-d','before:'.date('2012-01-01')],
                            'phone_number' => ['required','regex:/^[0-9]+$/','min:10','max:10']
                        ]);
                        if($validator->fails()){
                            return redirect('editAdminProfile')->withErrors($validator)->withInput();
                        }
                }


                //update changes   
                if($name != Auth::user()->name && $email != Auth::user()->email){
                        $user->name = $name;
                        $user->name_slug = $slug;
                        $user->email = $email;
                        $user->address = $address;
                        $user->dob = $dob;
                        $user->phone_number = $phone_number;
                        $user->save();
                }
                if($name != Auth::user()->name && $email == Auth::user()->email){
                        $user->name = $name;
                        $user->name_slug = $slug;
                        $user->address = $address;
                        $user->dob = $dob;
                        $user->phone_number = $phone_number;
                        $user->save();
                }
                else if($name == Auth::user()->name && $email != Auth::user()->email){
                        $user->email = $email;
                        $user->address = $address;
                        $user->dob = $dob;
                        $user->phone_number = $phone_number;
                        $user->save();
                }
                else if($name == Auth::user()->name && $email == Auth::user()->email){
                        $user->address = $address;
                        $user->dob = $dob;
                        $user->phone_number = $phone_number;
                        $user->save();
                }

                return redirect('editAdminProfile')->with('success',' Profile updated');
        }
    }

    //change admin profile
    public function change_profile_image(Request $request){
        $this->validate($request,[
            'profile_image' => 'required|image|max:3999',
        ]);

        //check if file is uploaded or not
        if ($request->hasFile('profile_image')) {
            //get file name with extension
            $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
            //get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just extension
            $fileExt = $request->file('profile_image')->getClientOriginalExtension();

            //create file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $fileNameToStore = str_replace(' ', '_', $fileNameToStore);
            //Upload the image and store it with new name in folder
            $image_resize = Image::make($request->file('profile_image')->getRealPath());              
            $image_resize->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $path = $image_resize->save(public_path('storage/profile_images/'. $fileNameToStore));

            //delete previous image
            $user = User::where('id', Auth::user()->id)->where('role','admin')->first();
            if($user->profile_image != 'no_image.jpg'){
                Storage::delete('public/profile_images/'.$user->profile_image);
            }

            $user->profile_image = $fileNameToStore;
            $user->save();

            return redirect('editAdminProfile')->with('success','Profile Image Saved');
        }
    }

    //update admin password
    public function updateAdminPassword(Request $request){
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('id',Auth::user()->id)->where('role', 'admin')->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('editAdminPassword')->with('success', 'Password Changed Successfully');
    }


    //update users template
    public function changeTemplateAdminEdit($id,Request $request){
        $this->validate($request, [
            'template' => 'required',
        ]);

        if($request->template == "creative" || $request->template == "cresume"){
            $info_data = AdditionalInfo::where('user_id', $id)->first();
            if(!isset($info_data)){
                $data = new AdditionalInfo;
                $data->user_id = $id;
                $data->template = $request->template;
                $data->save();

                return redirect('/updateTemplateAdminEdit/'.$id)->with('success', 'Template Successfully Changed');

            }
            else{
                $info_data->template = $request->template;
                $info_data->save();
    
                return redirect('/updateTemplateAdminEdit/'.$id)->with('success', 'Template Successfully Changed');
            }   
        }
        else{
            return redirect('/updateTemplateAdminEdit/'.$id)->with('warning', 'please select template from above');
        }
    }

    //add new image to users template
    public function addPortfolioImageAdminEdit(Request $request, $id){
        $this->validate($request, [
            'portfolio_image' => 'required|image|max:3999',
            'skill' => 'required',
            'image_title' => 'required|min:4|max:20',
            'about_image' => 'required|min:8|max:100'
        ]);


        //check if file is uploaded or not
        if ($request->hasFile('portfolio_image')) {
            //get file name with extension
            $fileNameWithExt = $request->file('portfolio_image')->getClientOriginalName();
            //get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just extension
            $fileExt = $request->file('portfolio_image')->getClientOriginalExtension();

            //create file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $fileNameToStore = str_replace(' ', '_', $fileNameToStore);
            //Upload the image and store it with new name in folder
            $image_resize = Image::make($request->file('portfolio_image')->getRealPath());              
            $image_resize->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            });

            $path = $image_resize->save(public_path('storage/portfolio_images/'. $fileNameToStore));

            //save data in database
            $portfolio = new Portfolio;
            $portfolio->user_id = $id;
            $portfolio->skill = $request->skill;
            $portfolio->portfolio_image = $fileNameToStore;
            $portfolio->image_title = $request->image_title;
            $portfolio->about_image = $request->about_image;
            $portfolio->save();

            return redirect('portfolioAdminEdit')->with('success','Image Added to your Portfolio');
        }
    }

    //get Portfolio data from the database
    public function getPortfolioDataAdminEdit(Request $request, $id){
        if ($request->ajax()) {
            $data = Portfolio::where('user_id', $id)->get();     
            return datatables()->of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){

                            $btn = '
                                    <button class="btn btn-danger btn-sm delete" id="'. $row->id .'" data-toggle="modal" data-target="#confirmModal"><span class="fas fa-trash-alt"></span></button>
                                   ';
     
                            return $btn;
                    })
                    ->editColumn('skill',function($row){
                        $skill_name = Skill::where('id',$row->skill)->first();
                        if($skill_name == null){
                            return "N/A";
                        }
                        return $skill_name->skill;
                    })
                    ->editColumn('created_at',function($row){
                        return date('Y-m-d H:i:s', strtotime($row->created_at));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    //delete selected portfolio image
    public function deletePortfolioImageAdminEdit($id){
        $image = Portfolio::findOrFail($id);
        $image_name = Portfolio::select('portfolio_image')->where('id',$id)->first();
        Storage::delete('public/portfolio_images/'.$image_name->portfolio_image);
        $image->delete();
    }

    //change user's profile image
    public function editUserProfileImage(Request $request, $id){
        $this->validate($request,[
            'profile_image' => 'required|image|max:3999',
        ]);

        //check if file is uploaded or not
        if ($request->hasFile('profile_image')) {
            //get file name with extension
            $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
            //get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just extension
            $fileExt = $request->file('profile_image')->getClientOriginalExtension();

            //create file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $fileNameToStore = str_replace(' ', '_', $fileNameToStore);
            //Upload the image and store it with new name in folder
            $image_resize = Image::make($request->file('profile_image')->getRealPath());              
            $image_resize->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $path = $image_resize->save(public_path('storage/profile_images/'. $fileNameToStore));

            //delete previous image
            $user = User::where('id', $id)->where('role', 'user')->first();
            if($user->profile_image != 'no_image.jpg'){
                Storage::delete('public/profile_images/'.$user->profile_image);
            }

            $user->profile_image = $fileNameToStore;
            $user->save();

            return redirect('/editUserProfileAdminEdit/'.$id)->with('success','Profile Image Saved');
        }
    }

    //update profile info
    public function updateUserProfileAdminEdit(Request $request, $id){
            $user = User::where('id', $id)->where('role', 'user')->first();
            
            $slug = Str::slug($request->name);
            $data['name'] = $request->name;
            $data['name_slug'] = $slug;
            $data['phone_number'] = $request->phone_number;
            $data['address'] = $request->address;
            $data['dob'] = $request->dob;
        
    
            $name = $request->name;
            $phone_number = $request->phone_number;
            $address = $request->address;
            $dob = $request->dob;
    
          
    
            if($name == $user->name && $slug == $user->name_slug && $address == $user->address && $dob == $user->dob && $phone_number == $user->phone_number){
                return redirect('/editUserProfileAdminEdit/'.$id)->with('warning'," Nothing to update");
            }
            else{
                    if($name != $user->name ){
                        $validator = Validator::make($data, [
                            'name' => ['required', 'string', 'min:8','max:255', 'unique:users,name','regex:/^[a-zA-Z\s]+$/'],
                            'name_slug' => ['unique:users,name_slug'],
                            'address' => ['required','string','min:8','max:40'],
                            'dob' => ['required','date_format:Y-m-d','before:'.date('2012-01-01')],
                            'phone_number' => ['required','regex:/^[0-9]+$/','min:10','max:10']
                        ]);
                        if($validator->fails()){
                            return redirect('/editUserProfileAdminEdit/'.$id)->withErrors($validator)->withInput();
                        }
                    }
                    else if($name == $user->name){
                        $validator = Validator::make($data, [
                                'address' => ['required','string','min:8','max:40'],
                                'dob' => ['required','date_format:Y-m-d','before:'.date('2012-01-01')],
                                'phone_number' => ['required','regex:/^[0-9]+$/','min:10','max:10']
                            ]);
                            if($validator->fails()){
                                return redirect('/editUserProfileAdminEdit/'.$id)->withErrors($validator)->withInput();
                            }
                    }
    
    
                    //update changes
                    
                    if($name != $user->name){
                            $user->name = $name;
                            $user->name_slug = $slug;
                            $user->address = $address;
                            $user->dob = $dob;
                            $user->phone_number = $phone_number;
                            $user->save();
                    }
                    else if($name == $user->name){
                            $user->address = $address;
                            $user->dob = $dob;
                            $user->phone_number = $phone_number;
                            $user->save();
                    }
    
                    return redirect('/editUserProfileAdminEdit/'.$id)->with('success',' Profile updated');
            }        
    
    }

    //update user's addditional info
    public function updateAdditionalInfoAdminEdit(Request $request,$id){
        $dat = User::where('id',$id)->where('role','user')->first();
        $this->validate($request,[
            'about' => 'required|min:15|max:400|string',
            'career_goal' => 'required|min:15|max:255|string',
            'languages' => 'required',
        ]);

        if(isset($request->facebook_link)){
            $this->validate($request,[
                'facebook_link' => 'url',
            ]);
        }
        else if(isset($request->twitter_link)){
            $this->validate($request,[
                'twitter_link' => 'url',
            ]);
        }
        else if(isset($request->google_plus_link)){
            $this->validate($request,[
                'google_plus_link' => 'url',
            ]);
        }
        else if(isset($request->instagram_link)){
            $this->validate($request,[
                'instagram_link' => 'url',
            ]);
        }


   
        $temp = $request->languages;
        $lang = "";
        for($i = 0; $i< count($temp);$i++) {
            if($i == 0){
                $lang = $lang .$temp[$i]; 
            }else{
                $lang = $lang .", ".$temp[$i];
            } 
        }
        
        $add = new AdditionalInfo;
        $find = AdditionalInfo::where('user_id',$dat->id)->first();
        if(!isset($find)){
            $add->user_id = $dat->id;
            $add->about = $request->about;
            $add->career_goal = $request->career_goal;
            $add->languages = $lang;

            if(isset($request->facebook_link)){
                $add->facebook_link = $request->facebook_link;
            }
            else{
                $add->facebook_link = null;
            }
            if(isset($request->twitter_link)){
                $add->twitter_link = $request->twitter_link;
            }
            else{
                $add->twitter_link = null;
            }
            if(isset($request->google_plus_link)){
                $add->google_plus_link = $request->google_plus_link;
            }
            else{
                $add->google_plus_link = null;
            }
            if(isset($request->instagram_link)){
                $add->instagram_link = $request->instagram_link;
            }
            else{
                $add->instagram_link = null;
            }

            $add->save();

            return redirect('/editAdditionalInfoAdminEdit/'.$id)->with('success', ' Additional Info Added');
        }
        else{
            $find->about = $request->about;
            $find->career_goal = $request->career_goal;
            $find->languages = $lang;

            if(isset($request->facebook_link)){
                $find->facebook_link = $request->facebook_link;
            }
            else{
                $find->facebook_link = null;
            }
            if(isset($request->twitter_link)){
                $find->twitter_link = $request->twitter_link;
            }
            else{
                $find->twitter_link = null;
            }
            if(isset($request->google_plus_link)){
                $find->google_plus_link = $request->google_plus_link;
            }
            else{
                $find->google_plus_link = null;
            }
            if(isset($request->instagram_link)){
                $find->instagram_link = $request->instagram_link;
            }
            else{
                $find->instagram_link = null;
            }

            $find->save();

            return redirect('/editAdditionalInfoAdminEdit/'.$id)->with('success', ' Additional Info Added');
        }
    }

    //add skills to user profile
    public function addUserSkillAdminEdit(Request $request,$id){
        $dat = User::where('id' ,$id)->where('role', 'user')->first();
        if(isset($request->other_skill)){
            $this->validate($request, [
                'skills' => 'array',
                'other_skill' => 'string|min:3|max:20'
            ]);
        }else{
            $this->validate($request, [
                'skills' => 'required|array',
            ]);
        }

        //check if user skill is already == 10 skills
        $user_skills = Skill::where('user_id', $dat->id)->get();
        //counter for skills with user id in session
        $count = 0;
        if(isset($user_skills)){
            foreach($user_skills as $row){
                ++$count;
            }
        }

        $count_selected_skills = 0;
        $skills = array();
        if($request->skills != null){
            $skills = $request->skills;
            foreach($skills as $row){
               ++$count_selected_skills;
            }
        }
        if($request->other_skill != null){
            $count_selected_skills+1;
        }

        // dd($count+$count_selected_skills);
        if($count <10 && ($count+$count_selected_skills) <=10){
            $skills = array();
            if(isset($request->skills)){
                $skills = $request->skills;
            }
         
            if(count($skills) != 0 && $request->other_skill == null){
                foreach($skills as $row){
                    $new_skill = new Skill;
                    $new_skill->user_id = $id;
                    $new_skill->skill = $row;
                    $new_skill->score = 0;
                    $new_skill->save();
                }
                
                return redirect('/addSkillsAdminEdit/'.$id)->with('success', ' Skills Added');
            }
            else if(count($skills) == 0 && $request->other_skill != null){
                $new_skill = new Skill;
                $new_skill->user_id = $id;
                $new_skill->skill = $request->other_skill;
                $new_skill->score = 0;
                $new_skill->save();

                return redirect('/addSkillsAdminEdit/'.$id)->with('success', ' Skills Added');
            }
            else if(count($skills) != 0 && $request->other_skill != null){
                if( (count($skills) + 1 ) > 10 ){
                    return redirect('/addSkillsAdminEdit/'.$id)->with('warning', 'Max Skills Allowed : 10');
                }
                else{
                    foreach($skills as $row){
                        $new_skill = new Skill;
                        $new_skill->user_id = $id;
                        $new_skill->skill = $row;
                        $new_skill->score = 0;
                        $new_skill->save();
                    }
                    $new_skill = new Skill;
                    $new_skill->user_id = $id;
                    $new_skill->skill = $request->other_skill;
                    $new_skill->score = 0;
                    $new_skill->save();

                    return redirect('/addSkillsAdminEdit/'.$id)->with('success', ' Skills Added');
                }
            }
        }
        else{
            return redirect('/addSkillsAdminEdit/'.$id)->with('warning', 'Max Skills Allowed : 10');
        }
    }

    //edit user's skills
    public function updateSkillAdminEdit(Request $request, $id, $user_id){
        $dat = User::where('id', $user_id)->where('role', 'user')->first();
        $this->validate($request, [
            'skill' => 'required|string|min:3|max:20',
            'score' => 'required|numeric|lte:100|gte:0'
        ]);
        $skill = Skill::where('id',$id)->where('user_id',$user_id)->first();
        if($request->skill == $skill->skill && $request->score == $skill->score){
            return redirect('/editSkillAdminEdit/'.$id .'/'.$user_id)->with('warning', ' Nothing to update');
        }

        $skill->skill = $request->skill;
        $skill->score = $request->score;
        $skill->save();

        return redirect('/editSkillAdminEdit/'.$id.'/'.$user_id)->with('success', ' Skill updated successfully');
    }

    //delete user's skill
    public function deleteSkillAdminEdit($id, $user_id){
        $dat = User::where('id', $user_id)->where('role', 'user')->first();
        $skill = Skill::where('id', $id)->where('user_id', $user_id)->first();
        if(isset($skill)){
            $skill->delete();
            return redirect('/addSkillsAdminEdit/'.$user_id)->with('success', 'Skill deleted');
        }
        else{
            return redirect('/addSkillsAdminEdit/'.$user_id)->with('warning', 'Skill not found');
        }
    }
    

}
