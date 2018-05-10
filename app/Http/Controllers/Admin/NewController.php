<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Input;
use News;
use Session;

class NewController extends Controller
{
    public function listnew()
    {
        if (Session::has('usernamelogin')) {
            $lstnew = \App\News::paginate(20);
            return view('admin.news')->with('lstnew', $lstnew);
        } else {
            return view('admin.index');
        }
    }
    public function newposts()
    {
        if (Session::has('usernamelogin')) {
            return view('admin.newposts');
        } else {
            return view('admin.index');
        }
    }
    public function manage(Request $request)
    {
        if ($request->input('id') == 0) {
            $news             = new \App\News();
            $news->title_en   = $request->title;
            $news->title_vi   = $request->titlevi;
            $news->content_en = $request->content;
            $news->content_vi = $request->contentvi;
            $news->category   = $request->category;
            $dt               = Carbon::now();
            $avatar           = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second;
            $files            = Input::file('image');
            $name             = $avatar . "." . $files->getClientOriginalExtension();
            $files->move(public_path() . '/images/news', $name);
            $news->image = $name;
            $news->save();
            // return redirect('/admin/news');
        } else {
            $news             = \App\News::where('id', '=', $request->id)->first();
            $news->title_en   = $request->title;
            $news->title_vi   = $request->titlevi;
            $news->content_en = $request->content;
            $news->content_vi = $request->contentvi;
            $news->category   = $request->category;
            if ($request->image != null) {
                File::delete(public_path() . '/images/news/' . $news->image);
                $dt     = Carbon::now();
                $avatar = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second;
                $files  = $request->image;
                $name   = $avatar . "." . $files->getClientOriginalExtension();
                $files->move(public_path() . '/images/news', $name);
                $news->image = $name;
            }
            $news->save();
        }
        return redirect('/admin/news');
    }
    public function edit($id)
    {
        if (Session::has('usernamelogin')) {
            $news = \App\News::where('id', '=', $id)->first();
            return view('admin.editposts')->with('news', $news);
        } else {
            return view('admin.index');
        }
    }
    public function delete($id)
    {
        if (Session::has('usernamelogin')) {
            $news = \App\News::where('id', '=', $id)->first();
            $news->delete();
            File::delete(public_path() . '/images/news/' . $news->image);
            return redirect($_SERVER['HTTP_REFERER']);
        } else {
            return view('admin.index');
        }
    }
}
