<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;
use Auth;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountSenders = DB::table('message')->where('accountReceiver', Auth::user()->username)->get();
        return view('message', ['userNow' => Auth::user(), 'accountSenders' => $accountSenders]);
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
    public function show($username)
    {
        $send = true;
        $fileName = Auth::user()->username."_".$username.'.txt';
        $fileInfo = DB::table('message')->where([['accountSender', Auth::user()->username],['accountReceiver', $username]])->first();
        if (isset($fileInfo)){
            $ct = Storage::get('public/message/'.$fileName);
            $contents = explode("\n", $ct);
        }
        else {
            $ct = Auth::user()->username."_".$username;
            Storage::put($fileName, '');
            Storage::move($fileName, 'public/message/'.$fileName);
            $message = new Message();
            $message->fileName = $fileName;
            $message->accountSender =  Auth::user()->username;                                                         
            $message->accountReceiver = $username;
            $message->save();
            $contents = explode("\n", $ct);
        }
        return view('message', ['userNow' => Auth::user(), 'contents'=> $contents, 'userRe' => $username, 'send' => $send]);
    }

    public function inbox(Request $request)
    {
        $fileName = Auth::user()->username."_".$request->user.'.txt';
        Storage::append('public/message/'.$fileName, $request->message);
        return redirect('/detailMessage/'.$request->user);
    }

    public function myMessage($accountSender)
    {
        //
        $accountSenders = DB::table('message')->where('accountReceiver', Auth::user()->username)->get();
        $fileName = $accountSender."_".Auth::user()->username.'.txt';
        $fileInfo = DB::table('message')->where([['accountReceiver', Auth::user()->username],['accountSender', $accountSender]])->first();
        $ct = Storage::get('public/message/'.$fileName);
        $contents = explode("\n", $ct);
        $students = DB::table('student')->where('account', $accountSender)->first();
        if (isset($students)){
            return view('message', ['userNow' => Auth::user(), 'contents'=> $contents, 'accountSenders' => $accountSenders, 'nameSender' => $students->fullName]);
        }
        $teachers = DB::table('teacher')->where('account', $accountSender)->first();
        if (isset($teachers)){
            return view('message', ['userNow' => Auth::user(), 'contents'=> $contents, 'accountSenders' => $accountSenders, 'nameSender' => $teachers->fullName]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function messageDelete(Request $request)
    {
        $fileName = Auth::user()->username."_". $request->userRe.'.txt';
        if ($request->delete){
            $ct = Storage::get('public/message/'.$fileName);
            Storage::put('2'.$fileName, '');
            Storage::move('2'.$fileName, 'public/message/2'.$fileName);
            $contents = explode("\n", $ct);
            foreach ($contents as $key => $ct){
                if ($key != $request->line){
                    Storage::append('public/message/2'.$fileName, $ct);
                }
            }
            Storage::delete('public/message/'.$fileName);
            Storage::move('public/message/2'.$fileName, 'public/message/'.$fileName);
        }
        return redirect('/detailMessage/'.$request->userRe);
    }

    public function messageEdit(Request $request)
    {
        $fileName = Auth::user()->username."_".$request->userRe.'.txt';
        if ($request->edit){
            $ct = Storage::get('public/message/'.$fileName);
            Storage::put('2'.$fileName, '');
            Storage::move('2'.$fileName, 'public/message/2'.$fileName);
            $contents = explode("\n", $ct);
            foreach ($contents as $key => $ct){
                if ($key != $request->line){
                    Storage::append('public/message/2'.$fileName, $ct);
                } else {
                    Storage::append('public/message/2'.$fileName, $request->messageEdit);
                }
            }
            Storage::delete('public/message/'.$fileName);
            Storage::move('public/message/2'.$fileName, 'public/message/'.$fileName);
        }
        return redirect('/detailMessage/'.$request->userRe);
    }
    
    public function openMessageEdit(Request $request)
    {
        $username = $request->userRe;
        $send = true;
        $fileName = Auth::user()->username."_".$username.'.txt';
        $fileInfo = DB::table('message')->where([['accountSender', Auth::user()->username],['accountReceiver', $username]])->first();
        if (isset($fileInfo)){
            $ct = Storage::get('public/message/'.$fileName);
            $contents = explode("\n", $ct);
        }
        else {
            $ct = Auth::user()->username."_".$username;
            Storage::put($fileName, '');
            Storage::move($fileName, 'public/message/'.$fileName);
            $message = new Message();
            $message->fileName = $fileName;
            $message->accountSender =  Auth::user()->username;                                                         
            $message->accountReceiver = $username;
            $message->save();
            $contents = explode("\n", $ct);
        }
        $openEdit = true;
        return view('message', ['userNow' => Auth::user(), 'contents'=> $contents, 'userRe' => $username,
         'send' => $send, 'openEdit' => $openEdit, 'line' => $request->line]);
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
