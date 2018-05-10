<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use File;
use Input;
use Carbon\Carbon;

include 'utils.php';

class ProjectController extends Controller
{
  public function index()
  {
    $lstproject = \App\Project::orderBy('updated_at', 'DESC')->paginate(20);
    return view("admin.projects")->with("lstproject", $lstproject);
  }
  
  public function newproject()
  {
    $lstinsideamenities = \App\Amenities::where('type', '=', 1)->get();
    $lstnearbyamenities = \App\Amenities::where('type', '=', 2)->get();
    $lstagent = \App\Author::all();
    return view('admin.newproject')->with("lstinsideamenities", $lstinsideamenities)
      ->with("lstnearbyamenities", $lstnearbyamenities)->with("lstagent", $lstagent);
  }
  
  public function manage(Request $request)
  {
    if ($request->id == 0) {
      $project = new \App\Project();
      $project->name_en = $request->name;
      $project->name_vi = $request->namevi;
      $project->investor = $request->investor;
      $project->address = $request->address;
      $project->description_en = $request->description;
      $project->description_vi = $request->descriptionvi;
      $project->sell_price = $request->sellprice;
      $project->lease_price = $request->leaseprice;
      $project->id_author = $request->author;
      $project->code = $request->code;
      $project->save();
      
      
      for ($i = 0; $i < count($request->amenities); $i++) {
        $project_amenities = new \App\ProjectAmenities();
        $project_amenities->id_project = $project->id;
        $project_amenities->id_amenities = $request->amenities[$i];
        $project_amenities->save();
      }
      return $project->id;
    } else {
      $project = \App\Project::where('id', '=', $request->id)->first();
      $project->name_en = $request->name;
      $project->name_vi = $request->namevi;
      $project->investor = $request->investor;
      $project->address = $request->address;
      $project->description_en = $request->description;
      $project->description_vi = $request->descriptionvi;
      $project->sell_price = $request->sellprice;
      $project->lease_price = $request->leaseprice;
      $project->id_author = $request->author;
      $project->code = $request->code;
      $project->save();
      
      
      $lstamenities = \App\ProjectAmenities::where('id_project', '=', $request->id)->get();
      for ($i = 0; $i < count($lstamenities); $i++) {
        $lstamenities[$i]->delete();
      }
      for ($i = 0; $i < count($request->amenities); $i++) {
        $project_amenities = new \App\ProjectAmenities();
        $project_amenities->id_project = $project->id;
        $project_amenities->id_amenities = $request->amenities[$i];
        $project_amenities->save();
      }
      return redirect('admin/project');
    }
  }
  
  public function upload(Request $request)
  {
    
    if ($request->hasFile('file')) {
      
      $files = Input::file('file');
      $index = 1;
      $id = $request->id;
      for ($i = 0; $i < count($files); $i++) {
        $fileExtension = $files[$i]->getClientOriginalExtension();
        $name = $id . "_" . $index . ".jpg";
        $realstate = new \App\ProjectImages();
        $realstate->id_project = $request->id;
        $realstate->id_images = $name;
        $realstate->save();
        $file_path = public_path() . '/images/projects/';
        $files[$i]->move($file_path, $name);
        watermark($fileExtension, $file_path . $name, $file_path . $name);
        $thumb_path = public_path() . '/images/thumb/projects/';
        createThumbnail($fileExtension, $file_path . $name, $thumb_path . $name);
        $index++;
      }
      
      return "OK";
    } else {
      return "ERROR";
    }
  }
  
  public function edit($id)
  {
    $project = \App\Project::where('id', '=', $id)->first();
    $lstinsideamenities = \App\Amenities::where('type', '=', 1)->get();
    $lstnearbyamenities = \App\Amenities::where('type', '=', 2)->get();
    $amenities = \App\ProjectAmenities::where('id_project', '=', $id)->get();
    $lstagent = \App\Author::all();
    return view('admin.editproject')->with('project', $project)
      ->with("lstinsideamenities", $lstinsideamenities)
      ->with("lstnearbyamenities", $lstnearbyamenities)
      ->with("lstamenitiesselected", $amenities)
      ->with("lstagent", $lstagent);
  }
  
  public function delete($id)
  {
    if (Session::has('usernamelogin')) {
      $project = \App\Project::where('id', '=', $id)->first();
      $project->delete();
      return redirect($_SERVER['HTTP_REFERER']);
    } else {
      return view('admin.index');
    }
  }
  
  public function listimage(Request $request)
  {
    $lstimage = \App\ProjectImages::where('id_project', '=', $request->id)->get();
    return $lstimage;
  }
  
  public function deleteimage(Request $request)
  {
    $lstimages = \App\ProjectImages::where('id_project', '=', $request->id)->get();
    for ($i = 0; $i < count($lstimages); $i++) {
      if ($lstimages[$i]->id_images == $request->id_images) {
        File::delete(public_path() . '/images/projects/' . $lstimages[$i]->id_images);
        $lstimages[$i]->delete();
        return "OK";
      }
      
    }
  }
  
  public function editupload(Request $request)
  {
    $files = Input::file('file');
    $index = 0;
    $dt = Carbon::now();
    $extension = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second . $dt->micro;
    for ($i = 0; $i < count($files); $i++) {
      $fileExtension = $files[$i]->getClientOriginalExtension();
      $name = $request->id . "_" . $index++ . $extension . ".jpg";
      $realstate = new \App\ProjectImages();
      $realstate->id_project = $request->id;
      $realstate->id_images = $name;
      $realstate->save();
      $file_path = public_path() . '/images/projects/';
      $files[$i]->move($file_path, $name);
      watermark($fileExtension, $file_path . $name, $file_path . $name);
      $thumb_path = public_path() . '/images/thumb/projects/';
      createThumbnail($fileExtension, $file_path . $name, $thumb_path . $name);
    }
    return "OK";
  }
}
