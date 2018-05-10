<?php

namespace App\Http\Controllers\Admin;

use Session;
use DetailRealEstate;
use App\RealEstate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Validator;
use Response;
use File;

include 'utils.php';

class DetailRealEstateController extends Controller
{
  public function getlistproperties()
  {
    if (Session::has('usernamelogin')) {
      $lstproperties = \App\DetailRealEstate::orderBy('id_key', 'desc')->paginate(20);
      $lsthot = array();
      $lstcode = array();
      foreach ($lstproperties as $properties) {
        $check = \App\HotProperties::where("id_detail_realestate", '=', $properties->id_key)->get();
        if ($check->count() == 0) {
          array_push($lsthot, 0);
        } else {
          array_push($lsthot, 1);
        }
        $text = \App\RealEstateCode::where('id_detail_realstate', '=', $properties->id_key)->get();
        array_push($lstcode, $text[0]->code);
      }
      
      return view('admin.properties')->with('lstproperties', $lstproperties)
        ->with('lsthot', $lsthot)
        ->with('lstcode', $lstcode);
    } else {
      return view('admin.index');
    }
  }
  
  public function newproperty()
  {
    if (Session::has('usernamelogin')) {
      $lsttype = \App\RealEstate::all();
      $lstpricetype = \App\Price::orderBy('id', 'asc')->get();
      $lstinsideamenities = \App\Amenities::where('type', '=', 1)->get();
      $lstnearbyamenities = \App\Amenities::where('type', '=', 2)->get();
      $lstfurnished = \App\Furnished::all();
      $lstauthor = \App\Author::all();
      $lstproject = \App\Project::all();
      return view('admin.newproperty')->with("lsttype", $lsttype)
        ->with("lstpricetype", $lstpricetype)
        ->with("lstinsideamenities", $lstinsideamenities)
        ->with("lstnearbyamenities", $lstnearbyamenities)
        ->with("lstfurnished", $lstfurnished)
        ->with("lstauthor", $lstauthor)
        ->with("lstproject", $lstproject);
    } else {
      return view('admin.index');
    }
  }
  
  public function manage(Request $request)
  {
    if ($request->id == 0) {
      $detail = new \App\DetailRealEstate();
      $id = \App\DetailRealEstate::where('type', '=', $request->type)->orderBy('created_at', 'desc')->first();
      if ($id != null) {
        $detail->id = ($id->id + 1);
      } else {
        $detail->id = 1;
      }
      $detail->type = $request->type;
      $detail->title_en = $request->title;
      $detail->title_vi = $request->titlevi;
      $detail->description_en = $request->description;
      $detail->description_vi = $request->descriptionvi;
      $detail->area = $request->area;
      $detail->bedroom = $request->bedroom;
      $detail->bathroom = $request->bathroom;
      $detail->price = $request->price;
      $detail->type_price = $request->typeprice;
      $detail->status = $request->status;
      $detail->address = $request->address;
      $detail->township = $request->township;
      $detail->available_time = $request->availabletime;
      $detail->id_author = $request->author;
      $detail->save();
      
      $id = \App\DetailRealEstate::where('type', '=', $request->type)->orderBy('created_at', 'desc')->first();
      $text = \App\RealEstate::where('id', '=', $request->type)->first();
      $number = "";
      for ($i = strlen($id->id); $i < 4; $i++) {
        $number .= "0";
      }
      
      
      $number .= $id->id;
      $text->code = $text->code . $detail->township . $number;
      $code = new \App\RealEstateCode();
      $code->id_detail_realstate = $detail->id_key;
      $code->code = $text->code;
      $code->save();
      
      
      if ($request->project != 0) {
        $project = new \App\RealEsateProject();
        $project->id_detail_realestate = $detail->id_key;
        $project->id_project = $request->project;
        $project->save();
      }
      
      
      for ($i = 0; $i < count($request->amenities); $i++) {
        $realestate = new \App\RealEstateAmenities();
        $realestate->id_detail_realestate = $detail->id_key;
        $realestate->id_amenities = $request->amenities[$i];
        $realestate->save();
      }
      if ($request->selectedfurnished != 0) {
        for ($i = 0; $i < count($request->furnished); $i++) {
          $realestate = new \App\RealEstateFurnished();
          $realestate->id_detail_realestate = $detail->id_key;
          $realestate->id_furnished = $request->furnished[$i];
          $realestate->save();
        }
      }
      
      
      return $detail->id_key;
    } else {
      $detail = \App\DetailRealEstate::where('id_key', '=', $request->id)->first();;
      $detail->type = $request->type;
      $detail->title_en = $request->title;
      $detail->title_vi = $request->titlevi;
      $detail->description_en = $request->description;
      $detail->description_vi = $request->descriptionvi;
      $detail->area = $request->area;
      $detail->bedroom = $request->bedroom;
      $detail->bathroom = $request->bathroom;
      $detail->price = $request->price;
      $detail->type_price = $request->typeprice;
      $detail->status = $request->status;
      $detail->address = $request->address;
      $detail->township = $request->township;
      $detail->available_time = $request->availabletime;
      $detail->id_author = $request->author;
      $detail->save();
      
      
      if ($request->project != 0) {
        $project = \App\RealEsateProject::where('id_detail_realestate', '=', $request->id)->get();
        if (count($project) > 0) {
          $project[0]->id_project = $request->project;
          $project[0]->save();
        } else {
          $project = new \App\RealEsateProject();
          $project->id_detail_realestate = $request->id;
          $project->id_project = $request->project;
          $project->save();
        }
        
      } else {
        $project = \App\RealEsateProject::where('id_detail_realestate', '=', $request->id)->get();
        if (count($project) > 0) {
          $project[0]->delete();
        }
      }
      
      
      $lstamenities = \App\RealEstateAmenities::where('id_detail_realestate', '=', $request->id)->get();
      for ($i = 0; $i < count($lstamenities); $i++) {
        $lstamenities[$i]->delete();
      }
      $lstfurnished = \App\RealEstateFurnished::where('id_detail_realestate', '=', $request->id)->get();
      for ($i = 0; $i < count($lstfurnished); $i++) {
        $lstfurnished[$i]->delete();
      }
      for ($i = 0; $i < count($request->amenities); $i++) {
        $realestate = new \App\RealEstateAmenities();
        $realestate->id_detail_realestate = $request->id;
        $realestate->id_amenities = $request->amenities[$i];
        $realestate->save();
      }
      if ($request->selectedfurnished != 0) {
        for ($i = 0; $i < count($request->furnished); $i++) {
          $realestate = new \App\RealEstateFurnished();
          $realestate->id_detail_realestate = $request->id;
          $realestate->id_furnished = $request->furnished[$i];
          $realestate->save();
        }
      }
      return redirect('admin/realestate');
      
    }
    
    
  }
  
  public function edit($id)
  {
    $lsttype = \App\RealEstate::all();
    $lstpricetype = \App\Price::orderBy('id', 'asc')->get();
    $lstinsideamenities = \App\Amenities::where('type', '=', 1)->get();
    $lstnearbyamenities = \App\Amenities::where('type', '=', 2)->get();
    $lstfurnished = \App\Furnished::all();
    $lstauthor = \App\Author::all();
    $lstproject = \App\Project::all();
    $property = \App\DetailRealEstate::where('id_key', '=', $id)->first();
    $amenities = \App\RealEstateAmenities::where('id_detail_realestate', '=', $property->id_key)->get();
    $furnished = \App\RealEstateFurnished::where('id_detail_realestate', '=', $property->id_key)->get();
    $project = \App\RealEsateProject::where('id_detail_realestate', '=', $property->id_key)->get();
    return view("admin.editproperty")->with("property", $property)
      ->with("lsttype", $lsttype)
      ->with("lstpricetype", $lstpricetype)
      ->with("lstinsideamenities", $lstinsideamenities)
      ->with("lstnearbyamenities", $lstnearbyamenities)
      ->with("lstfurnished", $lstfurnished)
      ->with("lstauthor", $lstauthor)
      ->with("lstproject", $lstproject)
      ->with("lstamenitiesselected", $amenities)
      ->with("lstfurnishedselected", $furnished)
      ->with("projectselected", $project);
  }
  
  public function delete($id)
  {
    if (Session::has('usernamelogin')) {
      $detail = \App\DetailRealEstate::where('id_key', '=', $id)->first();
      $detail->delete();
      $lstamenities = \App\RealEstateAmenities::where('id_detail_realestate', '=', $id)->get();
      for ($i = 0; $i < count($lstamenities); $i++) {
        $lstamenities[$i]->delete();
      }
      $lstfurnished = \App\RealEstateFurnished::where('id_detail_realestate', '=', $id)->get();
      for ($i = 0; $i < count($lstfurnished); $i++) {
        $lstfurnished[$i]->delete();
      }
      $lstimages = \App\RealEstateImages::where('id_detail_realestate', '=', $id)->get();
      for ($i = 0; $i < count($lstimages); $i++) {
        
        File::delete(public_path() . '/images/properties/' . $lstimages[$i]->id_images);
        $lstimages[$i]->delete();
      }
      
      $hotproperty = \App\HotProperties::where('id_detail_realestate', '=', $id)->get();
      for ($i = 0; $i < count($hotproperty); $i++) {
        $hotproperty[$i]->delete();
      }
      $project = \App\RealEsateProject::where('id_detail_realestate', '=', $id)->get();
      for ($i = 0; $i < count($project); $i++) {
        $project[$i]->delete();
      }
      
      $code = \App\RealEstateCode::where('id_detail_realstate', '=', $id)->get();
      for ($i = 0; $i < count($code); $i++) {
        $code[$i]->delete();
      }
      
      return redirect($_SERVER['HTTP_REFERER']);
    } else {
      return view('admin.index');
    }
    
    
  }
  
  public function upload(Request $request)
  {
    
    if ($request->hasFile('file')) {
      
      $files = Input::file('file');
      $index = 1;
      $id = $request->id;
      $count = count($files);
      for ($i = 0; $i < $count; $i++) {
        $fileExtension = $files[$i]->getClientOriginalExtension();
        $name = $id . "_" . $index++ . ".jpg";
        $realstate = new \App\RealEstateImages();
        $realstate->id_detail_realestate = $request->id;
        $realstate->id_images = $name;
        $realstate->save();
        $file_path = public_path() . '/images/properties/';
        $files[$i]->move($file_path, $name);
        watermark($fileExtension, $file_path . $name, $file_path . $name);
        $thumb_path = public_path() . '/images/thumb/properties/';
        createThumbnail($fileExtension, $file_path . $name, $thumb_path . $name);
      }
      
      return "OK";
    } else {
      return "ERROR";
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
      $realstate = new \App\RealEstateImages();
      $realstate->id_detail_realestate = $request->id;
      $realstate->id_images = $name;
      $realstate->save();
      $file_path = public_path() . '/images/properties/';
      $files[$i]->move($file_path, $name);
      watermark($fileExtension, $file_path . $name, $file_path . $name);
      $thumb_path = public_path() . '/images/thumb/properties/';
      createThumbnail($fileExtension, $file_path . $name, $thumb_path . $name);
      
    }
    
    return "OK";
  }
  
  public function deleteimage(Request $request)
  {
    $lstimages = \App\RealEstateImages::where('id_detail_realestate', '=', $request->id)->get();
    for ($i = 0; $i < count($lstimages); $i++) {
      if ($lstimages[$i]->id_images == $request->id_images) {
        File::delete(public_path() . '/images/properties/' . $lstimages[$i]->id_images);
        $lstimages[$i]->delete();
        return "OK";
      }
      
    }
  }
  
  public function search(Request $request)
  {
    $lstcodeproperties = \App\RealEstateCode::where('code', 'like', '%' . $request->request->get('query') . '%')->paginate(20);
    $lsthot = array();
    $lstcode = array();
    $lstproperties = array();
    foreach ($lstcodeproperties as $properties) {
      
      $properties = \App\DetailRealEstate::where("id_key", '=', $properties->toArray()['id_detail_realstate'])->get();
      array_push($lstproperties, $properties[0]);
    }
    foreach ($lstcodeproperties as $properties) {
      
      $check = \App\HotProperties::where("id_detail_realestate", '=', $properties->toArray()['id_detail_realstate'])->get();
      if ($check->count() == 0) {
        array_push($lsthot, 0);
      } else {
        array_push($lsthot, 1);
      }
      $text = \App\RealEstateCode::where('id_detail_realstate', '=', $properties->toArray()['id_detail_realstate'])->get();
      array_push($lstcode, $text[0]->code);
    }
    return view('admin.search')->with('lstproperties', $lstproperties)
      ->with('lsthot', $lsthot)
      ->with('lstcode', $lstcode);
    
    
  }
  
  public function select(Request $request)
  {
    $lstCode = \App\RealEstate::where('type', '=', $request->type)->get();
    //return $lstCode->toArray();
    return Response::json(array('data' => $lstCode));
    
  }
  
  public function listimage(Request $request)
  {
    $lstimage = \App\RealEstateImages::where('id_detail_realestate', '=', $request->id)->get();
    return Response::json(array('lstimage' => $lstimage));
  }
  
  
}
