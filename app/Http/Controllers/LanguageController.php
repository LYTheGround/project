<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{

    /**
     * @param Request $request
     */
    public function changeLanguage(Request $request)
    {
        if($request->ajax()){
            $request->session()->put('locale',$request->locale);
        }
    }
}
