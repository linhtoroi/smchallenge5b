<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    //
    public function postFile(Request $request){
        if($request->hasFile('myFile')){
            echo "co file";
            $file = $request->file('myFile');
            $fileName = '1.txt';
            $file->move('exercises', $fileName);
        }
        else{
            echo "chua co file";
        }
    }
    
    public function download($file_name) {
        $file_path = public_path('exercises/'.$file_name);
        return response()->download($file_path);
    }

}
