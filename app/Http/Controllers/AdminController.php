<?php

namespace App\Http\Controllers;

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



}
