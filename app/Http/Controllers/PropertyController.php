<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use Redirect;

class PropertyController extends Controller
{
  public function propertyDetail($name, $id)
  {
    $detail = \App\DetailRealEstate::where('id_key', '=', $id)->first();
    if (!$detail) {
      return view('wrong-page');
    }
    $detail->price = number_format($detail->price);
    $typeprice = \App\Price::where('id', '=', $detail->type_price)->first();
    $code = \App\RealEstateCode::where('id_detail_realstate', '=', $detail->id_key)->first();
    $author = \App\Author::where('id', '=', $detail->id_author)->first();
    
    $lsttemp = \App\RealEstateFurnished::where('id_detail_realestate', '=', $detail->id_key)->get();
    $lstfurnished = array();
    for ($i = 0; $i < count($lsttemp); $i++) {
      $furnished = \App\Furnished::where('id', '=', $lsttemp[$i]->id_furnished)->first();
      array_push($lstfurnished, $furnished);
    }
    $lsttemp = \App\RealEstateAmenities::where('id_detail_realestate', '=', $detail->id_key)->get();
    $lstAmenitiesInside = array();
    $lstAmenitiesNearby = array();
    $count = count($lsttemp);
    for ($i = 0; $i < $count; $i++) {
      $amenities = \App\Amenities::where('id', '=', $lsttemp[$i]->id_amenities)->first();
      if ($amenities) {
        if ($amenities->type == 1) {
          array_push($lstAmenitiesInside, $amenities);
        } else {
          array_push($lstAmenitiesNearby, $amenities);
        }
      }
    }
    $lstimage = \App\RealEstateImages::where('id_detail_realestate', '=', $id)->get();
    
    $project = \App\RealEsateProject::where('id_detail_realestate', '=', $id)->get();
    if ($project->count() > 0) {
      $detailproject = \App\Project::where('id', '=', $project[0]->id_project)->first();
    } else {
      $detailproject = null;
    }
    
    $detail->area = number_format($detail->area);
    
    return view('property-detail')->with('detail', $detail)
      ->with('typeprice', $typeprice->name)
      ->with('code', $code->code)
      ->with('author', $author)
      ->with('lstfurnished', $lstfurnished)
      ->with('lstAmenitiesInside', $lstAmenitiesInside)
      ->with('lstAmenitiesNearby', $lstAmenitiesNearby)
      ->with('detailproject', $detailproject)
      ->with('lstimage', $lstimage);
  }
  
  public function showProperties($name, $code, Request $request)
  {
    $lstImage = array();
    $lstpricetype = array();
    // rent or sale
    if (($code == 'rent') || ($code == 'sale')) {
      $q = \App\DetailRealEstate::query();
      $q->select('*')->from('detail_realestate as DR')
        ->leftJoin('realestate as R', 'DR.type', '=', 'R.id');
      $realEstateCode = new \stdClass();
      if ($code == 'rent') {
        $q->where('R.type', '=', 1)
          ->where('DR.status', '=', 1);
        $realEstateCode->name_en = "Rent";
        $realEstateCode->name_vi = "Cho Thuê";
      }
      if ($code == 'sale') {
        $q->where('R.type', '=', 2)
          ->where('DR.status', '=', 1);
        $realEstateCode->name_en = "Sale";
        $realEstateCode->name_vi = "Bán";
      }
      $lstProperties = $q->orderBy('DR.updated_at', 'desc')->paginate(12);
    } // hot
    elseif ($code == 'hot') {
      $q = \App\DetailRealEstate::query();
      $q->select('*')->from('detail_realestate as DR')
        ->leftJoin('hot_properties as H', 'DR.id_key', '=', 'H.id_detail_realestate')
        ->where('DR.status', '=', 1)
        ->orderBy('H.updated_at', 'desc');
      $lstProperties = $q->paginate(12);
      $realEstateCode = new \stdClass();
      $realEstateCode->name_en = "Hot Properties";
      $realEstateCode->name_vi = "Hot Properties";
    } // new
    elseif ($code == 'new') {
      $q = \App\DetailRealEstate::query();
      $q->where('status', '=', 1)->orderBy('updated_at', 'desc')->get();
      $lstProperties = $q->paginate(12);
      $realEstateCode = new \stdClass();
      $realEstateCode->name_en = "New Properties";
      $realEstateCode->name_vi = "Properties Mới";
    } // show properties by category
    else {
      $realEstateCode = \App\RealEstate::where('code', '=', $code)->first();
      $lstProperties = \App\DetailRealEstate::where('type', '=', $realEstateCode->id)->where('status', '=', 1)->orderBy('updated_at', 'desc')->paginate(12);
    }
    $size = count($lstProperties);
    for ($i = 0; $i < $size; $i++) {
      $lstProperties[$i]->price = number_format($lstProperties[$i]->price);
      $lstProperties[$i]->area = number_format($lstProperties[$i]->area);
    }
    $size = count($lstProperties);
    for ($i = 0; $i < $size; $i++) {
      $price = \App\Price::where('id', '=', $lstProperties[$i]->type_price)->first();
      array_push($lstpricetype, $price->name);
      
      $image = \App\RealEstateImages::where('id_detail_realestate', '=', $lstProperties[$i]->id_key)->first();
      $image ? array_push($lstImage, $image->id_images) : array_push($lstImage, "no_images.png");
    }
    return view('show-properties')
      ->with('lstProperties', $lstProperties)
      ->withPosts($lstProperties)
      ->with('lstImage', $lstImage)
      ->with('lstpricetype', $lstpricetype)
      ->with('realEstateCode', $realEstateCode);
  }
  public function createBooking(Request $request)
  {
      $booking = new Booking();
      if (!empty($request->name)) {
        $booking->name = $request->name;
      }
      if (!empty($request->phone)) {
        $booking->phone = $request->phone;
      }
      if (!empty($request->email)) {
        $booking->email = $request->email;
      }
      if (!empty($request->time)) {
        $booking->time = $request->time;
      }
      if (!empty($request->property_id)) {
        $booking->property_id = $request->property_id;
      }
      $booking->status = 'new';
      
      $booking->save();
      $status = "Booking success";
      return Redirect::back()->with('message','Booking Successful !');
  }
}
