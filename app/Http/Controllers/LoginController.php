<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\registerdetails;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function login(Request $request)
    {
        $loginid = $request->input('loginid');
        $loginpassword=$request->input('password');
        if ($loginid == 1001 || $loginid == 1002) {
            $match = registerdetails::where('loginid',$loginid)->where('loginpassword',$loginpassword)->first();
            // $count = count($match);
            if($match){

                return redirect('/studentlist');
            }else{

                Session::flash('success','Incorrect password');
                return back();
            }


        } else {
            Session::flash('success','You don\'t have access to this page.');
            return back()->with('error', 'You don\'t have access to this page.');
        }
    }
}
