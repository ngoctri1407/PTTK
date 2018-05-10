<?php

namespace App\Http\Controllers\Admin;

use Price;
use Session;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PriceController extends Controller
{
    public function index()
    {
        if(Session::has('usernamelogin'))
        {
            $lstprice = \App\Price::all();
            return view('admin.price')->with('lstprice',$lstprice);
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
            $check = \App\Price::where('name','=',$request->name)->get();
            if($check->count() == 0)
            {
                $price = new \App\Price();
                $price->name = $request->name;
                $price->save();
                return "OK";
            }
            else
            {
                return "ER";
            }
        }
        else
        {
            $check = \App\Price::where('name','=',$request->name)->get();
            if($check->count() == 0)
            {
                $price = \App\Price::where('id','=',$request->id)->first();
                $price->name = $request->name;
                $price->save();
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
            $price = \App\Price::where('id','=',$id)->first();
            $price->delete();
            return redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            return view('admin.index');
        }
    }
}
