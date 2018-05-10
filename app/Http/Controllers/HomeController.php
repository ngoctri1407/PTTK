<?php

namespace App\Http\Controllers;

use App\DetailRealEstate;
use App\HotProperties;
use App\Price;
use App\Project;
use App\ProjectImages;
use App\RealEstate;
use App\RealEstateImages;

include 'Admin/utils.php';

class HomeController extends Controller
{
  public function home()
  {
    $lsthotproperties = array();
    $lsthotimage = array();
    $lstcatvihot = array();
    $lstcatenhot = array();
    $lstpricetypenew = array();
    $lstpricetypehot = array();
    $lstnewimage = array();
    $lstcatvi = array();
    $lstcaten = array();
    $lstcatpro = array();
    $lstproimage = array();
    // hot properties
    $lsthot = HotProperties::orderBy('updated_at', 'desc')->get();
    $index = count($lsthot);
    $size = 0;
    for ($i = 0; $i < $index; $i++) {
      if ($size >= 6) {
        break;
      }
      $properties = DetailRealEstate::where('id_key', '=', $lsthot[$i]->id_detail_realestate)->where('status', '=', 1)->first();
      if ($properties) {
        $properties->price = number_format($properties->price);
        $properties->area = number_format($properties->area);
        array_push($lsthotproperties, $properties);
        $size++;
      }
    }
    $index = count($lsthotproperties);
    for ($i = 0; $i < $index; $i++) {
      $price = Price::where('id', '=', $lsthotproperties[$i]->type_price)->first();
      $price ? array_push($lstpricetypehot, $price->name) : array_push($lstpricetypehot, "");
      
      $image = RealEstateImages::where('id_detail_realestate', '=', $lsthotproperties[$i]->id_key)->first();
      $image ? array_push($lsthotimage, $image->id_images) : array_push($lsthotimage, "no_images.png");
      
      $cat = RealEstate::where('id', '=', $lsthotproperties[$i]->type)->first();
      if ($cat) {
        array_push($lstcatvihot, $cat->name_vi);
        array_push($lstcatenhot, $cat->name_en);
      }
    }
    
    // new properties
    $lstnewproperties = DetailRealEstate::where('status', '=', 1)->orderBy('updated_at', 'desc')->take(6)->get();
    
    for ($i = 0; $i < count($lstnewproperties); $i++) {
      $lstnewproperties[$i]->price = number_format($lstnewproperties[$i]->price);
      $lstnewproperties[$i]->area = number_format($lstnewproperties[$i]->area);
    }
    
    for ($i = 0; $i < count($lstnewproperties); $i++) {
      $price = Price::where('id', '=', $lstnewproperties[$i]->type_price)->first();
      $price ? array_push($lstpricetypenew, $price->name) : array_push($lstpricetypenew, "");
      
      $image = RealEstateImages::where('id_detail_realestate', '=', $lstnewproperties[$i]->id_key)->first();
      $image ? array_push($lstnewimage, $image->id_images) : array_push($lstnewimage, "no_images.png");
      
      $cat = RealEstate::where('id', '=', $lstnewproperties[$i]->type)->first();
      if ($cat) {
        array_push($lstcatvi, $cat->name_vi);
        array_push($lstcaten, $cat->name_en);
      }
    }
    
    // projects
    $lstproject = Project::orderBy('updated_at', 'desc')->take(6)->get();
    for ($i = 0; $i < count($lstproject); $i++) {
      $image = \App\ProjectImages::where('id_project', '=', $lstproject[$i]->id)->first();
      $image ? array_push($lstproimage, $image->id_images) : array_push($lstproimage, "no_images.png");
    }
    for ($i = 0; $i < count($lstproject); $i++) {
      if ($lstproject[$i]->code == 'UP') {
        array_push($lstcatpro, 'Up coming');
      } else if ($lstproject[$i]->code == 'EP') {
        array_push($lstcatpro, 'Existed');
      } else {
        array_push($lstcatpro, 'New');
      }
      
    }
    return view('home')
      ->with('lsthotproperties', $lsthotproperties)
      ->with('lstpricetypehot', $lstpricetypehot)
      ->with('lsthotimage', $lsthotimage)
      ->with('lstcatvihot', $lstcatvihot)
      ->with('lstcatenhot', $lstcatenhot)
      ->with('lstnewproperties', $lstnewproperties)
      ->with('lstpricetypenew', $lstpricetypenew)
      ->with('lstnewimage', $lstnewimage)
      ->with('lstcatvi', $lstcatvi)
      ->with('lstcaten', $lstcaten)
      ->with('lstproject', $lstproject)
      ->with('lstproimage', $lstproimage)
      ->with('lstcatpro', $lstcatpro);
  }
  
  public function resizeAllImages()
  {
    // resize all property images
    $images = RealEstateImages::all();
    foreach ($images as $image) {
      $fileExtension = pathinfo($image->id_images, PATHINFO_EXTENSION);
      $name = $image->id_images;
      $file_path = public_path() . '/images/properties/';
      $thumb_path = public_path() . '/images/thumb/properties/';
      createThumbnail($fileExtension, $file_path . $name, $thumb_path . $name);
    }
    // resize all project images
    $images = ProjectImages::all();
    foreach ($images as $image) {
      $fileExtension = pathinfo($image->id_images, PATHINFO_EXTENSION);
      $name = $image->id_images;
      $file_path = public_path() . '/images/projects/';
      $thumb_path = public_path() . '/images/thumb/projects/';
      createThumbnail($fileExtension, $file_path . $name, $thumb_path . $name);
    }
  }
}
