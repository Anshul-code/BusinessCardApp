<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ReferenceController extends Controller
{
     
    public function getReferenceInfo(Request $request){
        if ($request->ajax()) {
            $data = Reference::where('user_id', Auth::user()->id)->get();     
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
    
    //delete selected reference
    public function deleteReferenceData($id){
        $ref = Reference::findOrFail($id);
        $img = Reference::where('id', $id)->first();
        Storage::delete('public/references_images/'.$img->ref_image);
        $ref->delete();
    }


    public function newReference(Request $request)
    {
        $this->validate($request, [
            'ref_image' => 'required|image|max:3999',
            'name' => 'required|min:4|max:30',
            'company' => 'required|min:3|max:30',
            'ref_about' => 'required|min:8|max:200',
            'designation' => 'required|min:3|max:30',
        ]);


        //check if file is uploaded or not
        if ($request->hasFile('ref_image')) {
            //get file name with extension
            $fileNameWithExt = $request->file('ref_image')->getClientOriginalName();
            //get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just extension
            $fileExt = $request->file('ref_image')->getClientOriginalExtension();

            //create file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $fileNameToStore = str_replace(' ', '_', $fileNameToStore);
            //Upload the image and store it with new name in folder
            $image_resize = Image::make($request->file('ref_image')->getRealPath());              
            $image_resize->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            });

            $path = $image_resize->save(public_path('storage/references_images/'. $fileNameToStore));

            //save data in database
            $ref = new Reference;
            $ref->user_id = Auth::user()->id;
            $ref->ref_image = $fileNameToStore;
            $ref->name = $request->name;
            $ref->company = $request->company;
            $ref->designation = $request->designation;
            $ref->ref_about = $request->ref_about;
            $ref->save();

            return redirect('addReference')->with('success','Reference Added');
        }
    }

}
