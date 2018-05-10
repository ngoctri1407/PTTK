<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ApiSearchController extends Controller
{
  public function search(Request $request)
  {
    $keyword = $request->keyword;
    $result = [];
    switch ($request->object_type)
    {
      case "project":
      {
        // Search Project
        $projectList = \App\Project::orderBy('updated_at', 'desc');
        if ($keyword) {
          $projectList->where(function ($query) use ($keyword) {
            $query->where('name_en', 'LIKE', "%$keyword%")
                ->orWhere('name_vi', 'LIKE', "%$keyword%")
                ->orWhere('description_en', 'LIKE', "%$keyword%")
                ->orWhere('description_vi', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%");});
        }

        $result = $projectList->distinct()->paginate(12);

        for ($i = 0; $i < count($result); $i++) {
          if ($result[$i]->code == 'UP') {
            $result[$i]->cat_vi = 'Sắp Tới';
            $result[$i]->cat_en = 'Up coming';
          } else if ($result[$i]->code == 'EP') {
            $result[$i]->cat_vi = 'Hiện Tại';
            $result[$i]->cat_en = 'Existed';
          } else {
            $result[$i]->cat_vi = 'Mới';
            $result[$i]->cat_en = 'New';
          }

          $image = \App\ProjectImages::where('id_project', '=', $result[$i]->id)->first();
          $result[$i]->img = $image->id_images;
        }
      }; break;

      case "property":
      {
        //Search Property
        $q = \App\RealEstateCode::query();
        $q ->selectRaw('*, DR.type as realestateCatId')->from('realestate_code as RC')
            ->leftJoin('detail_realestate as DR', 'RC.id_detail_realstate', '=', 'DR.id_key')
            ->leftJoin('realestate as R', 'DR.type', '=', 'R.id')
            ->leftJoin('price as P', 'DR.type_price', '=', 'P.id')
            ->where('DR.status', '=', 1);

        if ($keyword) {
          $q->where(function ($query) use ($keyword) {
            $query->where("RC.code", "LIKE", "%$keyword%")
                ->orWhere('DR.title_en', 'LIKE', "%$keyword%")
                ->orWhere('DR.title_vi', 'LIKE', "%$keyword%")
                ->orWhere('DR.description_en', 'LIKE', "%$keyword%")
                ->orWhere('DR.description_vi', 'LIKE', "%$keyword%")
                ->orWhere('DR.address', 'LIKE', "%$keyword%");
          });
        }

        if ($request->type) {
          if ($request->propertyType && $request->propertyType !='APT') {
            $code = $request->propertyType;
            $q->where('RC.code', 'LIKE', "$code%")->where('DR.status', '=', 1);
          } else {
            if ($request->type == 'R') {
              $realestateType = 1;
            } else {
              $realestateType = 2;
            }
            $q->where('R.type', '=', $realestateType);
          }
        } else {
          $code = $keyword;
          $q->orwhere('RC.code', 'LIKE', "$code%")->where('DR.status', '=', 1);
        }

        if ($request->beds) {
          $q->where('DR.bedroom', '=', Input::get('beds'));
        }

        // if ($request->maxBed) {
        //   $q->where('DR.bedroom', '<=', Input::get('maxbed'));
        // }
        if ($request->baths) {
          $q->where('DR.bathroom', '=', Input::get('baths'));
        }
        if($request->pricePerAreaUnit){
          $q->where('P.name', '=', Input::get('pricePerAreaUnit'));

          if ($request->minPrice) {
            $q->where('DR.price', '>=', Input::get('minprice'));
          }

          if ($request->maxPrice && $request->maxPrice != 0) {
            $q->where('DR.price', '<=', Input::get('maxprice'));
          }
        }
        if($request->district){
          $q->where('DR.township', '=', Input::get('district'));
        }

        if($request->minArea){
          $q->where('DR.area', '>=', Input::get('minArea'));
        }

        if($request->maxArea && $request->maxArea != 0){
          $q->where('DR.area', '<=', Input::get('maxArea'));
        }
        
        if($request->fromDate && $request->toDate){
          $q->whereBetween('DR.available_time',[$request->fromDate,$request->toDate]);
        }



        // if ($request->date) {
        //   $curYear = date('Y');
        //   $searchDate = $curYear . '-' . $request->date . "-1";
        //   $endOfMonth = date("Y-m-t", strtotime($searchDate));

        //   $q->where('DR.available_time', '<=', "'" . $endOfMonth . "'");
        // }

        $result = $q->distinct()->orderBy('DR.updated_at', 'desc')->paginate(12);
        for ($i = 0; $i < count($result); $i++) {
          $result[$i]->price = number_format($result[$i]->price);
          $result[$i]->area  = number_format($result[$i]->area);
        }

        for ($i = 0; $i < count($result); $i++) {
          $image = \App\RealEstateImages::where('id_detail_realestate', '=', $result[$i]->id_key)->first();
          $result[$i]->img = $image->id_images;

          $cat = \App\RealEstate::where('id', '=', $result[$i]->realestateCatId)->first();
          $result[$i]->cat_vi = $cat->name_vi;
          $result[$i]->cat_en = $cat->name_en;

          $price = \App\Price::where('id', '=', $result[$i]->type_price)->first();
          $result[$i]->price_name = $price->name;
        }
      }; break;

      case "news":
      {
        // Search News
        $newsList = \App\News::orderBy('updated_at', 'desc');
        if ($keyword) {
          $newsList->where(function ($query) use ($keyword) {
            $query->Where('title_en', 'LIKE', "%$keyword%")
                ->orWhere('title_vi', 'LIKE', "%$keyword%")
                ->orWhere('content_en', 'LIKE', "%$keyword%")
                ->orWhere('content_vi', 'LIKE', "%$keyword%");});
        }
        $result = $newsList->paginate(12);
      }; break;
    }

    return response()->json([
        'resultList' => $result
    ], 200);
  }
}
