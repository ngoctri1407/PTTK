<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HotPropertiesController extends Controller
{
    public function add(Request $request)
    {
        $properties = new \App\HotProperties();
        $properties->id_detail_realestate = $request->id;
        $properties->save();
        return "OK";
    }
    public function remove(Request $request)
    {
        $properties = \App\HotProperties::where('id_detail_realestate','=',$request->id)->get();
        $properties[0]->delete();
        return "OK";
    }
}
