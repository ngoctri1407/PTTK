<?php

namespace App\Http\Controllers;

use Input;

class SearchSaveController extends Controller
{
  public function search()
  {
    //------------------------------------------- search properties -------------------------------------------//
    $keywords = Input::get('keywords');
    // search realestate
    $q = \App\RealEstateCode::query();
    $q->selectRaw('*, DR.type as realestateCatId')->from('realestate_code as RC')
      ->leftJoin('detail_realestate as DR', 'RC.id_detail_realstate', '=', 'DR.id_key')
      ->leftJoin('realestate as R', 'DR.type', '=', 'R.id')
      ->where('DR.status', '=', 1);
    
    if (Input::has('keywords')) {
      $q->where(function ($query) use ($keywords) {
        $query->where("RC.code", "LIKE", "%$keywords%")
          ->orWhere('DR.title_en', 'LIKE', "%$keywords%")
          ->orWhere('DR.title_vi', 'LIKE', "%$keywords%")
          ->orWhere('DR.description_en', 'LIKE', "%$keywords%")
          ->orWhere('DR.description_vi', 'LIKE', "%$keywords%")
          ->orWhere('DR.address', 'LIKE', "%$keywords%");
      });
    }
    
    if (Input::has('type')) {
      if (Input::has('type2')) {
        $code = Input::get('type2') . Input::get('type');
        $q->where('RC.code', 'LIKE', "$code%")->where('DR.status', '=', 1);
      } else {
        if (Input::get('type') == 'R') {
          $realestateType = 1;
        } else {
          $realestateType = 2;
        }
        $q->where('R.type', '=', $realestateType);
      }
    } else {
      $code = $keywords;
      $q->orwhere('RC.code', 'LIKE', "$code%")->where('DR.status', '=', 1);
    }
    
    if (Input::has('minbed')) {
      $q->where('DR.bedroom', '>=', Input::get('minbed'));
    }
    if (Input::has('maxbed')) {
      $q->where('DR.bedroom', '<=', Input::get('maxbed'));
    }
    if (Input::has('minprice')) {
      $q->where('DR.price', '>=', Input::get('minprice'));
    }
    if (Input::has('maxprice')) {
      $q->where('DR.price', '<=', Input::get('maxprice'));
    }
    if (Input::has('date')) {
      $curYear = date('Y');
      $searchDate = $curYear . '-' . Input::get('date') . "-1";
      $endOfMonth = date("Y-m-t", strtotime($searchDate));
      
      $q->where('DR.available_time', '<=', "'" . $endOfMonth . "'");
    }
    
    $result = $q->distinct()->orderBy('DR.updated_at', 'desc')->get();
    for ($i = 0; $i < count($result); $i++) {
      $result[$i]->price = number_format($result[$i]->price);
      $result[$i]->area = number_format($result[$i]->area);
    }
    $lstpricetype = array();
    $img = array();
    $lstcatvi = array();
    $lstcaten = array();
    for ($i = 0; $i < count($result); $i++) {
      $image = \App\RealEstateImages::where('id_detail_realestate', '=', $result[$i]->id_key)->first();
      array_push($img, $image->id_images);
      $cat = \App\RealEstate::where('id', '=', $result[$i]->realestateCatId)->first();
      array_push($lstcatvi, $cat->name_vi);
      array_push($lstcaten, $cat->name_en);
      $price = \App\Price::where('id', '=', $result[$i]->type_price)->first();
      array_push($lstpricetype, $price->name);
    }
    
    // search Project
    $lstproject = \App\Project::orderBy('updated_at', 'desc');
    if (Input::has('keywords')) {
      $lstproject->where(function ($query) use ($keywords) {
        $query->Where('name_en', 'LIKE', "%$keywords%")
          ->orWhere('name_vi', 'LIKE', "%$keywords%")
          ->orWhere('description_en', 'LIKE', "%$keywords%")
          ->orWhere('description_vi', 'LIKE', "%$keywords%")
          ->orWhere('address', 'LIKE', "%$keywords%");
      });
    }
    $resultPro = $lstproject->distinct()->get();
    
    $lstcatpro = array();
    $count = count($resultPro);
    for ($i = 0; $i < $count; $i++) {
      if ($resultPro[$i]->code == 'UP') {
        array_push($lstcatpro, 'Up coming');
      } else if ($resultPro[$i]->code == 'EP') {
        array_push($lstcatpro, 'Existed');
      } else {
        array_push($lstcatpro, 'New');
      }
    }
    $lstCatImg = array();
    for ($i = 0; $i < $count; $i++) {
      $image = \App\ProjectImages::where('id_project', '=', $resultPro[$i]->id)->first();
      array_push($lstCatImg, $image->id_images);
    }
    
    // search News
    $lstnews = \App\News::orderBy('updated_at', 'desc');
    if (Input::has('keywords')) {
      $lstnews->where(function ($query) use ($keywords) {
        $query->Where('title_en', 'LIKE', "%$keywords%")
          ->orWhere('title_vi', 'LIKE', "%$keywords%")
          ->orWhere('content_en', 'LIKE', "%$keywords%")
          ->orWhere('content_vi', 'LIKE', "%$keywords%");
      });
    }
    $resultnews = $lstnews->get();
    
    // search
    return view('search')->with('result', $result)
      ->with('img', $img)
      ->with('key', $keywords)
      ->with('lstcatvi', $lstcatvi)
      ->with('lstcaten', $lstcaten)
      ->with('lstCatImg', $lstCatImg)
      ->with('lstpricetype', $lstpricetype)
      ->with('lstproject', $resultPro)
      ->with('lstcatpro', $lstcatpro)
      ->with('lstnews', $resultnews);
  }
  
  public function save()
  {
    return view('save');
  }
}
