<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // public function getAuthLogin(){
    //     return view('signIn');
    // // }
    // public function postAuthLogin(Request $request){
    //     $arr = ['username'=>$request->username, 
    //             'password'=>$request->password];
    //     if (Auth::attempt($arr)){
    //         Auth::user()->save();
    //         $user = Auth::user();
    //         echo $user->username;
    //         return view('list', ['userNow'=>Auth::user()]);
    //     }
    //     else{
    //         //dd('dang nhap ko thanh cong');
    //     }
    // }
    public function logout(Request $request){
        Auth::logout();
        return redirect('./login');
    }

}
