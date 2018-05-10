<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiProjectController extends Controller
{
    public function getNextItem(Request $request){
      $request->limit =true;
      $responseAPI = $this->getProjectList($request);
      $responseAPI = $responseAPI->getData();
      if(isset($responseAPI->projectList->data[0]))
      $request->id = $responseAPI->projectList->data[0]->id;
      return $this->getProjectDetail($request);
    }
    public function getProjectList(Request $request)
    {
        if($request->code == null){
            $query = \App\Project::orderBy('updated_at', 'desc');
        }
        else {
            $query = \App\Project::where('code', '=', $request->code)->orderBy('updated_at', 'desc');
        }
        if($request->limit){
          $timeProjectItemCurr = \App\Project::select('updated_at')->where('id','=',$request->id)->first();
          $projectList = $query->where('updated_at',$request->isBack ? '>' : '<',$timeProjectItemCurr->updated_at)->paginate(1);
        }
        else{
          $projectList = $query->paginate(12);
        }
        for ($i = 0; $i < count($projectList); $i++) {
            $image = \App\ProjectImages::where('id_project', '=', $projectList[$i]->id)->first();
            $image ? $projectList[$i]->image_name = $image->id_images : $projectList[$i]->image_name = "no_images.png";

            if ($projectList[$i]->code == 'UP') {
                $categoryNameVi = 'Sắp Tới';
                $categoryNameEn = 'Up coming';
            } else if ($projectList[$i]->code == 'EP') {
                $categoryNameVi = 'Hiện Tại';
                $categoryNameEn = 'Existed';
            } else {
                $categoryNameVi = 'Mới';
                $categoryNameEn = 'New';
            }

            $projectList[$i]->cat_vi = $categoryNameVi;
            $projectList[$i]->cat_en = $categoryNameEn;
        }

        return response()->json([
            'projectList' => $projectList
        ], 200);
    }

    public function getProjectDetail(Request $request)
    {
        $detail = \App\Project::where('id', '=', $request->id)->first();
        if (!$detail) {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }

        if ($detail->code == 'EP') {
            $projectCodeName = "EXISTED PROJECT";
        }
        if ($detail->code == 'NP') {
            $projectCodeName = "NEW PROJECT";
        }
        if ($detail->code == 'UP') {
            $projectCodeName = "UPCOMING PROJECT";
        }
        $detail->projectCodeName = $projectCodeName;

        $lsttemp = \App\ProjectAmenities::where('id_project', '=', $request->id)->get();
        $lstAmenitiesInside = array();
        $lstAmenitiesNearby = array();
        for ($i = 0; $i < count($lsttemp); $i++) {
            $amenities = \App\Amenities::where('id', '=', $lsttemp[$i]->id_amenities)->first();
            if ($amenities) {
                if ($amenities->type == 1) {
                    array_push($lstAmenitiesInside, $amenities);
                } else {
                    array_push($lstAmenitiesNearby, $amenities);
                }
            }
        }

        $author   = \App\Author::where('id', '=', $detail->id_author)->first();
        $lstimage = \App\ProjectImages::where('id_project', '=', $request->id)->get();

        return response()->json([
            'detail'=> $detail,
            'author' => $author,
            'amenitiesInsideList' => $lstAmenitiesInside,
            'amenitiesNearbyList' => $lstAmenitiesNearby,
            'imageList' => $lstimage,
        ], 200);
    }
}
