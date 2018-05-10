<?php

namespace App\Http\Controllers;

class ProjectController extends Controller
{
  public function projectDetail($name, $id)
  {
    $detail = \App\Project::where('id', '=', $id)->first();
    if (!$detail) {
      return view('wrong-page');
    }
    // $author    = \App\Author::where('id', '=', $detail->id_author)->first();
    
    $lsttemp = \App\ProjectAmenities::where('id_project', '=', $id)->get();
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
    
    $projectStr = "";
    if ($detail->code == 'EP') {
      $projectStr = "EXISTED PROJECT";
    }
    if ($detail->code == 'NP') {
      $projectStr = "NEW PROJECT";
    }
    if ($detail->code == 'UP') {
      $projectStr = "UPCOMING PROJECT";
    }
    $author = \App\Author::where('id', '=', $detail->id_author)->first();
    $lstimage = \App\ProjectImages::where('id_project', '=', $id)->get();
    
    return view('project-detail')
      ->with('detail', $detail)
      ->with('projectStr', $projectStr)
      ->with('lstAmenitiesInside', $lstAmenitiesInside)
      ->with('lstAmenitiesNearby', $lstAmenitiesNearby)
      ->with('author', $author)
      ->with('lstimage', $lstimage);
  }
  
  public function showProjects($name, $code)
  {
    $lstproimage = array();
    $lstProjects = \App\Project::where('code', '=', $code)->orderBy('updated_at', 'desc')->paginate(12);
    
    $size = count($lstProjects);
    for ($i = 0; $i < $size; $i++) {
      $image = \App\ProjectImages::where('id_project', '=', $lstProjects[$i]->id)->first();
      $image ? array_push($lstproimage, $image->id_images) : array_push($lstproimage, "no_images.png");
    }
    
    return view('show-projects')->with('lstProjects', $lstProjects)->withPosts($lstProjects)->with('lstproimage', $lstproimage);
  }
  
  public function showAllProjects()
  {
    $lstproimage = array();
    $lstProjects = \App\Project::query()->orderBy('updated_at', 'desc')->paginate(12);
    
    $size = count($lstProjects);
    for ($i = 0; $i < $size; $i++) {
      $image = \App\ProjectImages::where('id_project', '=', $lstProjects[$i]->id)->first();
      $image ? array_push($lstproimage, $image->id_images) : array_push($lstproimage, "no_images.png");
    }
    
    return view('show-projects')->with('lstProjects', $lstProjects)->withPosts($lstProjects)->with('lstproimage', $lstproimage);
  }
}
