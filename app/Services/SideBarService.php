<?php

namespace App\Services;

class SideBarService
{
  // get type
  public function getTypeSearch()
  {
    $lstrealestate = \App\RealEstate::all();
    return $lstrealestate;
  }
  
  // code for menu navbar
  public function getLstTypeNav($type)
  {
    $typeId = 1;
    if ($type == 'sale') {
      $typeId = 2;
    }
    $lstType = \App\RealEstate::where('type', '=', $typeId)->get();
    return $lstType;
  }
  
  // get relative property
  public function getRelatedPro($proId)
  {
    // get type
    $pro = \App\DetailRealEstate::where('id_key', '=', $proId)->first();
    $type = $pro->type;
    // get list
    $lstPro = \App\DetailRealEstate::where('type', '=', $type)->where('id_key', '!=', $proId)->inRandomOrder()->take(16)->orderBy('updated_at', 'DESC')->get();
    return $lstPro;
  }
  
  public function getHotPro()
  {
    $lsthot = \App\HotProperties::all();
    $size = count($lsthot);
    if ($size >= 5) {
      $index = 5;
    } else {
      $index = count($lsthot);
    }
    $lsthotproperties = array();
    for ($i = 0; $i < $index; $i++) {
      $properties = \App\DetailRealEstate::where('id_key', '=', $lsthot[$i]->id_detail_realestate)->first();
      $lstimage = \App\RealEstateImages::where('id_detail_realestate', '=', $lsthot[$i]->id_detail_realestate)->first();
      array_push($lsthotproperties, $properties);
    }
    return $lsthotproperties;
  }
  
  public function getProInProject($projectId)
  {
    $proIdArr = \App\RealEsateProject::where('id_project', '=', $projectId)->where('id', '!=', $projectId)->inRandomOrder()->take(16)->orderBy('updated_at', 'DESC')->get();
    $lstPro = array();
    $count = count($proIdArr);
    for ($i = 0; $i < $count; $i++) {
      $property = \App\DetailRealEstate::where('id_key', '=', $proIdArr[$i]->id_detail_realestate)->first();
      array_push($lstPro, $property);
    }
    return $lstPro;
  }
  
  public function getNewInCat($newsId)
  {
    // get type
    $news = \App\News::where('id', '=', $newsId)->first();
    $category = $news->category;
    // get list
    $lstNews = \App\News::where('category', '=', $category)->where('id', '!=', $newsId)->inRandomOrder()->take(16)->orderBy('updated_at', 'DESC')->get();
    return $lstNews;
  }
  
  // get image
  public function getProImage($id)
  {
    $image = \App\RealEstateImages::where('id_detail_realestate', '=', $id)->first();
    if ($image) {
      return $image->id_images;
    } else {
      return 'no_images.png';
    }
  }
  
  public function kd($str)
  {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = str_replace(" ", "-", str_replace("&*#39;", "", $str));
    //Special string
    $str = preg_replace("/( |!|$|%|')/", '', $str);
    $str = preg_replace("/(̀|́|̉|$|>)/", '', $str);
    $str = preg_replace("'<[\/\!]*?[^<>]*?>'si", "", $str);
    $str = str_replace(" / ", "-", $str);
    $str = str_replace("/", "-", $str);
    $str = str_replace(" - ", "-", $str);
    $str = str_replace("_", "-", $str);
    $str = str_replace(" ", "-", $str);
    $str = str_replace("ß", "ss", $str);
    $str = str_replace("&", "", $str);
    $str = str_replace("%", "", $str);
    $str = preg_replace("/[^A-Za-z0-9-]/", "", $str);
    
    $str = str_replace("----", "-", $str);
    $str = str_replace("---", "-", $str);
    $str = str_replace("--", "-", $str);
    
    return $str;
  }
  
  public function getPriceType($idTypePrice)
  {
    $price = \App\Price::where('id', '=', $idTypePrice)->first();
    if ($price) {
      return $price->name;
    }
    return "";
  }
}
