<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Auth;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $userNow = Auth::user();
        return view('list', ['students' => $students, 'teachers' => $teachers, 'userNow' => Auth::user()]);
    }

    /**
    * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function type($id)
    {
        $students = Student::all();
        $teachers = Teacher::all();
        if ($id==1)
            return view('list', ['students' => $students, 'teachers' => $teachers, 'userNow' => Auth::user()]);
        else if ($id==2)
            return view('list', ['students' => $students, 'userNow' => Auth::user()]);
        else if ($id==3)
            return view('list', ['teachers' => $teachers, 'userNow' => Auth::user()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo "index";
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
        $user = new User();
        $user->username = $request->input("username");
        $user->password = $request->input("password");
        $user->save();

        $student = new Student();
        $student->account = $request->input("username");
        $student->fullName = $request->input("fullName");
        $student->email = $request->input("email");
        $student->phoneNumber = $request->input("phoneNumber");
        $student->save();

        echo "store";
        return response($student, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        //$students = Student::find($username);
        $students = DB::table('student')->where('account', $username)->get();
        $detail = true;
        if (!$students->isEmpty())
            return view('list', ['students' => $students, 'detail' => $detail, 'username'=>$username, 'userNow' => Auth::user()]);
        $teachers = DB::table('teacher')->where('account', $username)->get();
        if (!$teachers->isEmpty())
            return view('list', ['teachers' => $teachers, 'detail' => $detail, 'username'=>$username, 'userNow' => Auth::user()]);
    }

    public function editComplete(Request $request)
    {
        //
        if (isset($request->password)){
            DB::table('users')->where('username', Auth::user()->username)->update(['password' => bcrypt($request->password)]);
            echo "okioki";
        }
        DB::table('student')->where('account', Auth::user()->username)->update(['email' => $request->email, 'phoneNumber' => $request->phoneNumber]);
        return redirect('/detail/'.Auth::user()->username);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $students = DB::table('student')->where('account', Auth::user()->username)->first();
        return view('edit', ['students' => $students, 'userNow' => Auth::user()]);
    }
    public function editCompleteForTeacher(Request $request)
    {
        
        echo $request->email;
        echo $request->fullName;
        echo $request->phoneNumber;
        echo $request->account;
        echo $request->accountedit;

        if (isset($request->password)){
            DB::table('users')->where('username', $request->accountedit)->update(['password' => bcrypt($request->password)]);
            echo "okioki";
        }
        DB::table('users')->where('username', $request->accountedit)->update(['username' => $request->account]);
        DB::table('student')->where('account', $request->account)->update(['email' => $request->email, 'phoneNumber' => $request->phoneNumber,
        'fullName' => $request->fullName, 'account' => $request->account]);
        return redirect('/detail/'.$request->account);
    }

    public function editForTeacher($username)
    {
        $students = DB::table('student')->where('account', $username)->first();
        return view('editForTeacher', ['students' => $students, 'userNow' => Auth::user()]);
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
        echo "update: ".$id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        //
        DB::table('users')->where('username', $username)->delete();
        return redirect('/listOfUsers');
    }
}
