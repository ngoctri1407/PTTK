<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Account;
use Session;
use App\Booking;
class AdminController extends Controller
{
    public function getListBooking(Request $request) {
    $query = Booking::Paginate(12);
    return view('admin.booking')->with('bookingList',$query);
  }

    public function index()
    {
        if(Session::has('usernamelogin'))
        {
            return redirect('admin/realestate');
        }
        else
        {
            return view('admin.index');    
        }
    }
    
    public function login(Request $request)
    {
        $account = \App\Account::where('username','=',$request->username)->where('password','=',MD5($request->password))->get();
        if($account->count() == 0)
        {
            $error = "Username or Password is incorrect";
            return view("admin.index")->with('error',$error);
        }
        else
        {
            Session::put('usernamelogin',$account->lists('username')[0]);
            return redirect('admin/realestate');
        }
    }
    
    public function logout(Request $request)
    {
        $request->session()->forget('usernamelogin');
        return redirect('admin');
    }
    
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
