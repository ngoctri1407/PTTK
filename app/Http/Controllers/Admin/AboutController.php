<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
class AboutController extends Controller
{
    public  function index()
    {
        $about = \App\About::first();
        return view('admin.about')->with("about",$about);
    }
    public function manage(Request $request)
    {
        $about = \App\About::where('id',$request->id)->first();
        $about->content_vi = $request->contentvi;
        $about->content_en = $request->content;
        $about->save();
        return redirect('admin/about');
    }
}
