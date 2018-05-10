<?php

namespace App\Http\Controllers;

class NewsController extends Controller
{
  public function showNews($category)
  {
    $cat = $category;
    $lstNews = \App\News::orderBy('created_at', 'desc');
    if ($cat == 'news') {
      $lstNews->where('category', '=', 1);
    }
    
    if ($cat == 'recruitment') {
      $lstNews->where('category', '=', 2);
    }
    
    if ($cat == 'advertisement') {
      $lstNews->where('category', '=', 3);
    }
    
    if ($cat == 'pr') {
      $lstNews->where('category', '=', 4);
    }
    // Except commercial
    $lstNews->where('category', '!=', 5);
    
    $lstNews = $lstNews->paginate(12);
    
    $lstNewsCatEn = array();
    $lstNewsCatVi = array();
    for ($i = 0; $i < count($lstNews); $i++) {
      if ($lstNews[$i]->category == 1) {
        array_push($lstNewsCatEn, 'News');
        array_push($lstNewsCatVi, 'Tin tức');
      }
      if ($lstNews[$i]->category == 2) {
        array_push($lstNewsCatEn, 'Recruitment');
        array_push($lstNewsCatVi, 'Tuyển dụng');
      }
      if ($lstNews[$i]->category == 3) {
        array_push($lstNewsCatEn, 'Advertisement');
        array_push($lstNewsCatVi, 'Quảng cáo');
      }
      if ($lstNews[$i]->category == 4) {
        array_push($lstNewsCatEn, 'PR');
        array_push($lstNewsCatVi, 'PR');
      }
    }
    
    return view('show-news')
      ->with('lstNews', $lstNews)
      ->withPosts($lstNews)
      ->with('lstNewsCatVi', $lstNewsCatVi)
      ->with('lstNewsCatEn', $lstNewsCatEn)
      ->with('category', $category);
  }
  
  public function showCommercial()
  {
    $lstNews = \App\News::where('category', '=', 5)->orderBy('created_at', 'desc');
    $lstNews = $lstNews->paginate(9);
    $lstNewsCatVi = "Commercial";
    $lstNewsCatEn = 'Commercial';
    $category = 'Commercial';
    return view('show-news-commercial')
      ->with('lstNews', $lstNews)
      ->withPosts($lstNews)
      ->with('lstNewsCatVi', $lstNewsCatVi)
      ->with('lstNewsCatEn', $lstNewsCatEn)
      ->with('category', $category);
  }
  
  public function newsDetail($name, $id)
  {
    $News = \App\News::where('id', '=', $id)->get();
    if (!$News) {
      return view('wrong-page');
    }
    $catNewsEn = '';
    $catNewsVi = '';
    for ($i = 0; $i < count($News); $i++) {
      if ($News[$i]->category == 1) {
        $catNewsEn = 'News';
        $catNewsVi = 'Tin tức';
      }
      if ($News[$i]->category == 2) {
        $catNewsEn = 'Recruitment';
        $catNewsVi = 'Tuyển dụng';
      }
      if ($News[$i]->category == 3) {
        $catNewsEn = 'Advertisement';
        $catNewsVi = 'Quảng cáo';
      }
      if ($News[$i]->category == 4) {
        $catNewsEn = 'PR';
        $catNewsVi = 'PR';
      }
      if ($News[$i]->category == 5) {
        $catNewsEn = 'Commercial';
        $catNewsVi = 'Commercial';
      }
    }
    return view('news-detail')->with('newsdetail', $News)
      ->with('catNewsVi', $catNewsVi)
      ->with('catNewsEn', $catNewsEn);
  }
}
