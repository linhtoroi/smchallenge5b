<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Teacher;
use App\Models\Homework;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Auth;
class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $exercise = Exercise::all();
        $teachers = Teacher::all();
        $detailExercise = DB::table('exercise')
                            ->join('teacher','teacherAccount','=','account')
                            ->select('fullName', 'fileName', 'id')
                            ->get();
        $detailHomework = DB::table('homework')
                            ->join('student', 'studentAccount','=','account')
                            ->select('fullName', 'fileName', 'id')
                            ->get();
        return view('exercise', ['detailExercise' => $detailExercise, 'userNow' => Auth::user()]);
    }

    public function postExerciseFile(Request $request){
        if($request->hasFile('myFile')){
            
            $file = $request->file('myFile');
            $file1 = $request->file('myFile')->getClientOriginalName();
            $filename = pathinfo($file1, PATHINFO_FILENAME);
            $filename = strtolower($filename);  
            $extension = pathinfo($file1, PATHINFO_EXTENSION);
            $fileName = $filename.'.'.$extension;

            $exercise = new Exercise();
            $exercise->fileName = $fileName;
            $exercise->teacherAccount = 'admin';
            $exercise->save();

            $fileName = $exercise->id.'_'.$fileName;
            DB::table('exercise')->where('id', $exercise->id)->update(['fileName' => $fileName]);

            $path = $request->file('myFile')->store('exercises', 'public');
            $contents = Storage::move('public/'.$path, 'public/exercises/'.$fileName);
            return redirect('/exercise');
        }
        else{
            echo "chua co file";
        }
    }

    public function postHomeworkFile(Request $request){
        if($request->hasFile('myhomework')){
            $file = $request->file('myhomework');
            $file1 = $request->file('myhomework')->getClientOriginalName();
            $filename = pathinfo($file1, PATHINFO_FILENAME);
            $extension = pathinfo($file1, PATHINFO_EXTENSION);
            $fileName = $request->input('id').'_'.Auth::user()->username.'_'.$filename.'.'.$extension;

            $isexisthomework = DB::table('homework')->where([['id', $request->input('id')], ['studentAccount', Auth::user()->username]])->first();
            if (isset($isexisthomework)){
                $path = $isexisthomework->fileName;
                Storage::delete('public/homework/'.$path);
                DB::table('homework')->where([['id', $request->input('id')], ['studentAccount', Auth::user()->username]])->update(['fileName' => $fileName]);
            }
            else{
                $homework = new Homework();
                $homework->fileName = $fileName;
                $homework->id =  $request->input('id');                                                            
                $homework->studentAccount = Auth::user()->username;
                $homework->save();
            }
            $path = $request->file('myhomework')->store('homework', 'public');
            $contents = Storage::move('public/'.$path, 'public/homework/'.$fileName);
            return redirect('/detailExercise/'.$request->input('id'));
        }
        else{
            echo "chua co file";
        }
    }

    public function downloadExercise($file_name) {
        $file_path = 'public/exercises/'.$file_name;
        return Storage::download($file_path);
    }

    public function downloadHomework($file_name) {
        $file_path = 'public/homework/'.$file_name;
        return Storage::download($file_path);
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
        echo "store";
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
        $detailExercise = DB::table('exercise')
                            ->join('teacher', 'teacherAccount','=','account')
                            ->select('fullName', 'fileName', 'id')->where('id', $id)
                            ->get();
        $detailHomework = DB::table('homework')
                            ->join('student', 'studentAccount','=','account')
                            ->select('fullName', 'fileName', 'id')->where('id', $id)
                            ->get();
        $status = 1;
        return view('exercise', ['detailExercise' => $detailExercise, 'status' => $status, 'detailHomework' => $detailHomework, 'id' => $id, 'userNow' => Auth::user()]);
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
