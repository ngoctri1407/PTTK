<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Furnished;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FurnishedController extends Controller
{
    public function index()
    {
        if(Session::has('usernamelogin'))
        {
            $lstfurnished = \App\Furnished::paginate(20);
            return view('admin.furnished')->with('lstfurnished',$lstfurnished);
        }
        else
        {
            return view('admin.index');
        }
    }
    public function manage(Request $request)
    {
        if($request->id == "")
        {
            $check = \App\Furnished::where('name_en','=',$request->name)->where('name_vi','=',$request->namevi)->get();
            if($check->count() == 0)
            {
                $furnished = new \App\Furnished();
                $furnished->name_en = $request->name;
                $furnished->name_vi = $request->namevi;
                $furnished->save();
                return "OK";
            }
            else
            {
                return "ER";
            }
        }
        else
        {
            $check = \App\Furnished::where('name_en','=',$request->name)->where('name_vi','=',$request->namevi)->get();
            if($check->count() == 0)
            {
                $furnished = \App\Furnished::where('id','=',$request->id)->first();
                $furnished->name_en = $request->name;
                $furnished->name_vi = $request->namevi;
                $furnished->save();
                return "OK";
            }
            else
            {
                return "ER";
            }

        }
    }
    public function delete($id)
    {
        if(Session::has('usernamelogin'))
        {
            $furnished = \App\Furnished::where('id','=',$id)->first();
            $furnished->delete();
            return redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            return view('admin.index');
        }
    }
}
