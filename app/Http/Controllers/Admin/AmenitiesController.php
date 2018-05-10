<?php

namespace App\Http\Controllers\Admin;
use Amenities;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AmenitiesController extends Controller
{
    public function inside()
    {
        if(Session::has('usernamelogin'))
        {
            $lstamenities = \App\Amenities::where('type', '=', '1')->paginate(20);
            return view('admin.inside')->with('lstamenities', $lstamenities);
        }
        else
        {
            return view('admin.index');
        }
    }
    public function nearby()
    {
        if(Session::has('usernamelogin'))
        {
            $lstamenities = \App\Amenities::where('type', '=', '2')->paginate(20);
            return view('admin.nearby')->with('lstamenities', $lstamenities);
        }
        else
        {
            return view('admin.index');
        }
    }
    public function manageinside(Request $request)
    {
        if($request->id == "")
        {
            $check = \App\Amenities::where('name_en','=',$request->name)->where('name_vi','=',$request->namevi)->get();
            if($check->count() == 0)
            {
                $amenities = new \App\Amenities;
                $amenities->name_en = $request->name;
                $amenities->name_vi = $request->namevi;
                $amenities->type = 1;
                $amenities->save();
                return "OK";
            }
            else
            {
                return "ER";
            }
        }
        else
        {
            $check = \App\Amenities::where('name_en','=',$request->name)->where('name_vi','=',$request->namevi)->where('type', '=', 1)->get();
            if($check->count() == 0)
            {
                $amenities = \App\Amenities::where('id','=',$request->id)->first();
                $amenities->name_en = $request->name;
                $amenities->name_vi = $request->namevi;
                $amenities->save();
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
            $amenities = \App\Amenities::where('id','=',$id)->first();
            $amenities->delete();
            return redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            return view('admin.index');
        }
    }
    public function managenearby(Request $request)
    {
        if($request->id == "")
        {
            $check = \App\Amenities::where('name_en','=',$request->name)->where('name_vi','=',$request->namevi)->where('type', '=', 2)->get();
            if($check->count() == 0)
            {
                $amenities = new \App\Amenities;
                $amenities->name_en = $request->name;
                $amenities->name_vi = $request->namevi;
                $amenities->type = 2;
                $amenities->save();
                return "OK";
            }
            else
            {
                return "ER";
            }
        }
        else
        {
            $check = \App\Amenities::where('name_en','=',$request->name)->where('name_vi','=',$request->namevi)->get();
            if($check->count() == 0)
            {
                $amenities = \App\Amenities::where('id','=',$request->id)->first();
                $amenities->name_en = $request->name;
                $amenities->name_vi = $request->namevi;
                $amenities->save();
                return "OK";
            }
            else
            {
                return "ER";
            }

        }
    }
}
