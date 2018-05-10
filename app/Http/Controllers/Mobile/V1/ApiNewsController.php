<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services;

class ApiNewsController extends Controller
{
    public function getNextItem(Request $request){
      $request->limit =true;
      $responseAPI = $this->getNewsList($request);
      $responseAPI = $responseAPI->getData();
      if(isset($responseAPI->newsList->data[0]))
      $request->id = $responseAPI->newsList->data[0]->id;
      return $this->getNewsDetail($request);
    }
    public function getNewsList(Request $request)
    {
        $newsList = \App\News::orderBy('created_at', 'desc');
        switch ($request->code){
            case 'news':{
                $newsList->where('category', '=', 1);
                $newsCategoryEn = 'News';
                $newsCategoryVi = 'Tin Tức';
            }; break;

            case 'recruitment':{
                $newsList->where('category', '=', 2);
                $newsCategoryEn = 'Recruitment';
                $newsCategoryVi = 'Tin Tuyển Dụng';
            }; break;

            case 'advertisement':{
                $newsList->where('category', '=', 3);
                $newsCategoryEn = 'Advertisement';
                $newsCategoryVi = 'Quảng Cáo';
            }; break;

            case 'pr':{
                $newsList->where('category', '=', 4);
                $newsCategoryEn = 'PR';
                $newsCategoryVi = 'PR';
            }; break;

            default: {
                $newsList->where('category', '!=', 5);
                $newsCategoryEn = null;
                $newsCategoryVi = null;
            }; break;
        }
        if($request->limit){
          $timeProjectItemCurr = \App\News::select('updated_at')->where('id','=',$request->id)->first();
          $newsList = $newsList->where('updated_at',$request->isBack?'>':'<',$timeProjectItemCurr->updated_at)->paginate(1);
        }
        else
        $newsList = $newsList->paginate(9);

        for ($i = 0; $i < count($newsList); $i++) {
            $newsList[$i]->newsCategoryEn = $newsCategoryEn;
            $newsList[$i]->newsCategoryVi = $newsCategoryVi;
        }

        return response()->json([
            'newsList' => $newsList
        ], 200);
    }

    public function getNewsDetail(Request $request)
    {
        $detail = \App\News::where('id', '=', $request->id)->first();
        if (!$detail) {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }

        switch ($detail->category){
            case 1:{
                $newsCategoryEn = 'News';
                $newsCategoryVi = 'Tin Tức';
            }; break;

            case 2:{
                $newsCategoryEn = 'Recruitment';
                $newsCategoryVi = 'Tin Tuyển Dụng';
            }; break;

            case 3:{
                $newsCategoryEn = 'Advertisement';
                $newsCategoryVi = 'Quảng Cáo';
            }; break;

            case 4:{
                $newsCategoryEn = 'PR';
                $newsCategoryVi = 'PR';
            }; break;

            default: {
                $newsCategoryEn = null;
                $newsCategoryVi = null;
            }; break;
        }

        $detail->newsCategoryEn = $newsCategoryEn;
        $detail->newsCategoryVi = $newsCategoryVi;

        $services = new Services\SideBarService;
        $lstRelatedPro = $services->getNewInCat($request->id);

        return response()->json([
            'detail' => $detail,
            'relatedList' => $lstRelatedPro
        ], 200);
    }
}
