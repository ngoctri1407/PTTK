<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Input;
use Session;

class AuthorController extends Controller
{
    //
    public function index()
    {
        if (Session::has('usernamelogin')) {
            $lstauthor = \App\Author::paginate(20);
            return view('admin.author')->with('lstauthor', $lstauthor);
        } else {
            return view('admin.index');
        }
    }
    public function newauthor()
    {
        return view('admin.newauthor');
    }
    public function manage(Request $request)
    {
        if ($request->id == 0) {
            $author         = new \App\Author;
            $author->name   = $request->name;
            $author->phone  = $request->phone;
            $author->title  = $request->title;
            $author->email  = $request->email;
            $author->office = $request->office;
            $dt             = Carbon::now();
            $avatar         = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second;
            $files          = Input::file('avatar');
            $name           = $avatar . "." . $files->getClientOriginalExtension();
            $files->move(public_path() . '/images/agent', $name);
            $author->image = $name;
            $author->save();
            // return redirect('/admin/author');
        } else {

            $author         = \App\Author::where('id', '=', $request->id)->first();
            $author->name   = $request->name;
            $author->title  = $request->title;
            $author->phone  = $request->phone;
            $author->email  = $request->email;
            $author->office = $request->office;
            if ($request->avatar != null) {
                File::delete(public_path() . '/images/agent/' . $author->image);
                $dt     = Carbon::now();
                $avatar = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second;
                $files  = $request->avatar;
                $name   = $avatar . "." . $files->getClientOriginalExtension();
                $files->move(public_path() . '/images/agent', $name);
                $author->image = $name;
            }
            $author->save();
        }
        return redirect('/admin/author');
    }
    public function edit($id)
    {
        $author = \App\Author::where('id', '=', $id)->first();
        //var_dump($author);
        return view('admin.editauthor')->with("author", $author);
    }
    public function delete($id)
    {
        if (Session::has('usernamelogin')) {
            $author = \App\Author::where('id', '=', $id)->first();
            $author->delete();
            File::delete(public_path() . '/images/agent/' . $author->image);
            return redirect($_SERVER['HTTP_REFERER']);
        } else {
            return view('admin.index');
        }
    }

}
