<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiAboutController extends Controller
{
    public function getAbout()
    {
        $about = \App\About::first();
        return response()->json([
            'about'=> $about
        ], 200);
    }
}
