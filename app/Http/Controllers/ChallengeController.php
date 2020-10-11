<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Challenge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Auth;
class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $detailChallenge = DB::table('challenge')
                            ->join('teacher', 'teacherAccount','=','account')
                            ->select('id', 'fullName', 'hint')
                            ->get();
        return view('challenge', ['detailChallenge' => $detailChallenge, 'userNow' => Auth::user()]);
    }


    public function postChallengeFile(Request $request){
        if($request->hasFile('myFile')){
            $file = $request->file('myFile');
            $file1 = $request->file('myFile')->getClientOriginalName();
            $filename = pathinfo($file1, PATHINFO_FILENAME);
            $filename = strtolower($filename);  
            $extension = pathinfo($file1, PATHINFO_EXTENSION);
            
            $challenge = new Challenge();
            $challenge->hint = $request->input('hint');
            $challenge->teacherAccount = 'admin';
            $challenge->save();

            $fileName = $challenge->id.'_'.$filename.'.'.$extension;

            $path = $request->file('myFile')->store('challenges', 'public');
            $contents = Storage::move('public/'.$path, 'public/challenges/'.$fileName);
            return redirect('/challenge');
        }
        else{
            echo "chua co file";
        }
    }

    public function answerChallenge(Request $request){
        if($request->input('answer')){
                $str = $request->input('answer');
                $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);  // Chuyển câu trả lời của sinh viên từ có dấu thành không dấu
                $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
                $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
                $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
                $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
                $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
                $str = preg_replace("/(đ)/", 'd', $str);
                $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
                $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
                $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
                $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
                $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
                $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
                $str = preg_replace("/(Đ)/", 'D', $str);
                $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
                $str = strtolower($str);  
            $filename = $request->input('id').'_'.$str;
            //echo $filename;
            $path = 'challenges';
            $files = Storage::files('/public/challenges');
            $right = false;
            foreach ($files as $file){
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                if ($fileName == $filename){
                    $right = true;
                    $ct = Storage::get('/public/challenges/'.$fileName.'.txt');
                    $contents = explode("\n", $ct); 
                    return view('right', ['contentChallenge' => $contents, 'userNow' => Auth::user()]);
                    break;
                }
            }
            if ($right == false){
                return redirect('/detailChallenge/'.$request->input('id'));
            }
            //return redirect('/right');
        }
        else{
            echo "chua co file";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $detailChallenge = DB::table('challenge')
                            ->join('teacher', 'teacherAccount','=','account')
                            ->select('id', 'fullName', 'hint')->where('id', $id)
                            ->get();
        $status = 1;
        return view('challenge', ['detailChallenge' => $detailChallenge, 'status' => $status, 'userNow' => Auth::user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
