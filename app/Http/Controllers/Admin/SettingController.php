<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use File;
use Input;

class SettingController extends Controller
{
    public function viewSetting(){
    	return view('admin.setting');
    }
   
    public function manage(Request $request)
    {

        if($request->hasFile('image')) {

            $files = Input::file('image');
            $name = "banner-bg.jpg";
            $file_path = public_path() . '/images/bg/';
            $files->move($file_path,$name);
            sleep(1);

            return redirect('admin/setting');
        }
        else
        {
            return "ERROR";
        }
    }
}
