<?php

namespace App\Http\Controllers\Admin;
use Session;
use App\RealEstate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RealEstateController extends Controller
{
    public function index()
    {
        if(Session::has('usernamelogin'))
        {
            $lstrealestate = \App\RealEstate::all();
            return view('admin.realestate')->with('lstrealestate',$lstrealestate);
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
            $check = \App\RealEstate::where('name','=',$request->name)->get();
            if($check->count() == 0)
            {
                //$realestate = new \App\RealEstate();
                //$realestate->name = $request->name;
                //$realestate->type = 1;
                //$realestate->code = "LSA";
                //$realestate->save();
                return "OK";
            }
            else
            {
                return "ER";
            }
        }
        else
        {
            $check = \App\RealEstate::where('name_en','=',$request->name)->where('code','=',$request->code)->where('name_vi','=',$request->namevi)->get();
            if($check->count() == 0)
            {
                $realestate = \App\RealEstate::where('id','=',$request->id)->first();
                $realestate->name_en = $request->name;
                $realestate->name_vi = $request->namevi;
                $realestate->code = $request->code;
                $realestate->save();
                return "OK";
            }
            else
            {
                return "ER";
            }

        }
    }
    
}
