<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Amenities;
use App\Author;
use App\DetailRealEstate;
use App\Furnished;
use App\Http\Controllers\Controller;
use App\Price;
use App\Project;
use App\RealEsateProject;
use App\RealEstate;
use App\RealEstateAmenities;
use App\RealEstateCode;
use App\RealEstateFurnished;
use App\RealEstateImages;
use Illuminate\Http\Request;

class ApiPropertyController extends Controller
{
  public function getSavedList(Request $request)
  {
    $query = DetailRealEstate::query();
    $request->arrListSaved = json_decode($request->arrListSaved);
    $query->select('*')->from('detail_realestate as DR')
      ->leftJoin('realestate as R', 'DR.type', '=', 'R.id')
      ->whereIn('DR.id_key', $request->arrListSaved)
      ->where('DR.status', '=', 1)
      ->orderBy('DR.updated_at', 'desc');
    $arrListSaved = $query->get();
    
    $size = count($arrListSaved);
    for ($i = 0; $i < $size; $i++) {
      $arrListSaved[$i]->price = number_format($arrListSaved[$i]->price);
      $arrListSaved[$i]->area = number_format($arrListSaved[$i]->area);
      
      $price = Price::where('id', '=', $arrListSaved[$i]->type_price)->first();
      $arrListSaved[$i]->price_name = $price->name;
      
      $image = RealEstateImages::where('id_detail_realestate', '=', $arrListSaved[$i]->id_key)->first();
      $image ? $arrListSaved[$i]->image_name = $image->id_images : $arrListSaved[$i]->image_name = "no_images.png";
      
      $cat = RealEstate::where('id', '=', $arrListSaved[$i]->type)->first();
      if ($cat) {
        $arrListSaved[$i]->cat_vi = $cat->name_vi;
        $arrListSaved[$i]->cat_en = $cat->name_en;
      }
    }
    
    return response()->json([
      'arrListSaved' => $arrListSaved,
    ], 200);
  }
  
  public function getNextItem(Request $request)
  {
    $request->limit = true;
    $responseAPI = $this->getPropertyList($request);
    $responseAPI = $responseAPI->getData();
    if (isset($responseAPI->propertyList->data[0]))
      $request->id = $responseAPI->propertyList->data[0]->id_key;
    return $this->getPropertyDetail($request);
  }
  
  public function getPropertyList(Request $request)
  {
    $query = DetailRealEstate::query();
    
    switch ($request->type) {
      case 'rent':
      case 'sale': {
        if ($request->type == 'rent')
          $propertyType = 1;
        else
          $propertyType = 2;
        
        $query->select('*')->from('detail_realestate as DR')
          ->leftJoin('realestate as R', 'DR.type', '=', 'R.id')
          ->where('R.type', '=', $propertyType)
          ->where('DR.status', '=', 1)
          ->orderBy('DR.updated_at', 'desc');
      };
        break;
      
      case 'hot': {
        $query->select('*')->from('detail_realestate as DR')
          ->leftJoin('hot_properties as H', 'DR.id_key', '=', 'H.id_detail_realestate')
          ->where('DR.status', '=', 1)
          ->orderBy('H.updated_at', 'desc');
      };
        break;
      
      case 'new': {
        $query->from('detail_realestate as DR')->where('DR.status', '=', 1)->orderBy('DR.updated_at', 'desc');
      };
        break;
      
      default: {
        $realEstateCode = RealEstate::where('code', '=', $request->realEstateCode)->first();
        $query->from('detail_realestate as DR')->where('DR.type', '=', $realEstateCode->id)->where('DR.status', '=', 1)->orderBy('DR.updated_at', 'desc');
      };
        break;
    };
    if ($request->limit) {
      $timePropertyItemCurr = DetailRealEstate::select('updated_at')->where('id_key', '=', $request->id)->first();
      $propertyList = $query->where('DR.updated_at', $request->isBack ? '>' : '<', $timePropertyItemCurr->updated_at)->paginate(1);
    } else
      $propertyList = $query->paginate(12);
    
    $size = count($propertyList);
    for ($i = 0; $i < $size; $i++) {
      $propertyList[$i]->price = number_format($propertyList[$i]->price);
      $propertyList[$i]->area = number_format($propertyList[$i]->area);
      
      $price = Price::where('id', '=', $propertyList[$i]->type_price)->first();
      $propertyList[$i]->price_name = $price->name;
      
      $image = RealEstateImages::where('id_detail_realestate', '=', $propertyList[$i]->id_key)->first();
      $image ? $propertyList[$i]->image_name = $image->id_images : $propertyList[$i]->image_name = "no_images.png";
      
      $cat = RealEstate::where('id', '=', $propertyList[$i]->type)->first();
      if ($cat) {
        $propertyList[$i]->cat_vi = $cat->name_vi;
        $propertyList[$i]->cat_en = $cat->name_en;
      }
    }
    
    return response()->json([
      'propertyList' => $propertyList
    ], 200);
  }
  
  public function getPropertyDetail(Request $request)
  {
    
    $detail = DetailRealEstate::where('id_key', '=', $request->id)->first();
    
    if (!$detail) {
      return response()->json([
        'message' => 'Not Found'
      ], 404);
    }
    
    $detail->price = number_format($detail->price);
    $detail->area = number_format($detail->area);
    
    $price = Price::where('id', '=', $detail->type_price)->first();
    $detail->price_name = $price->name;
    
    $code = RealEstateCode::where('id_detail_realstate', '=', $detail->id_key)->first();
    $detail->code = $code->code;
    
    $author = Author::where('id', '=', $detail->id_author)->first();
    
    $lsttemp = RealEstateFurnished::where('id_detail_realestate', '=', $detail->id_key)->get();
    $lstfurnished = array();
    for ($i = 0; $i < count($lsttemp); $i++) {
      $furnished = Furnished::where('id', '=', $lsttemp[$i]->id_furnished)->first();
      array_push($lstfurnished, $furnished);
    }
    
    $lsttemp = RealEstateAmenities::where('id_detail_realestate', '=', $detail->id_key)->get();
    $lstAmenitiesInside = array();
    $lstAmenitiesNearby = array();
    $count = count($lsttemp);
    for ($i = 0; $i < $count; $i++) {
      $amenities = Amenities::where('id', '=', $lsttemp[$i]->id_amenities)->first();
      if ($amenities) {
        if ($amenities->type == 1) {
          array_push($lstAmenitiesInside, $amenities);
        } else {
          array_push($lstAmenitiesNearby, $amenities);
        }
      }
    }
    
    $lstimage = RealEstateImages::where('id_detail_realestate', '=', $request->id)->get();
    
    $project = RealEsateProject::where('id_detail_realestate', '=', $request->id)->get();
    if ($project->count() > 0) {
      $detailproject = Project::where('id', '=', $project[0]->id_project)->first();
    } else {
      $detailproject = null;
    }
    
    return response()->json([
      'detail' => $detail,
      'author' => $author,
      'furnitureList' => $lstfurnished,
      'amenitiesInsideList' => $lstAmenitiesInside,
      'amenitiesNearbyList' => $lstAmenitiesNearby,
      'projectDetail' => $detailproject,
      'imageList' => $lstimage,
    ], 200);
  }
  
  public function getRandomList(Request $request)
  {
    $type = $request->type;
    $query = DetailRealEstate::query();
    
    $categoryIds = [];
    switch ($type) {
      case 'rent':
        $categoryIds = RealEstate::where('type', 1)->pluck('id');
        break;
      case 'sale':
        $categoryIds = RealEstate::where('type', 2)->pluck('id');
        break;
    }
    
    $propertyList = $query->whereIn('type', $categoryIds)->inRandomOrder()->limit(20)->get();
    
    $size = count($propertyList);
    for ($i = 0; $i < $size; $i++) {
      $propertyList[$i]->price = number_format($propertyList[$i]->price);
      $propertyList[$i]->area = number_format($propertyList[$i]->area);
      
      $price = Price::where('id', '=', $propertyList[$i]->type_price)->first();
      $propertyList[$i]->price_name = $price->name;
      
      $image = RealEstateImages::where('id_detail_realestate', '=', $propertyList[$i]->id_key)->first();
      $image ? $propertyList[$i]->image_name = $image->id_images : $propertyList[$i]->image_name = "no_images.png";
      
      $cat = RealEstate::where('id', '=', $propertyList[$i]->type)->first();
      if ($cat) {
        $propertyList[$i]->cat_vi = $cat->name_vi;
        $propertyList[$i]->cat_en = $cat->name_en;
      }
    }
    
    return response()->json([
      'propertyList' => $propertyList,
    ], 200);
  }
}
