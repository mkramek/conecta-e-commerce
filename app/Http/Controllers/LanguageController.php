<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $req)
    {
        $lang = $req->input("lang");
        $route = json_decode($req->input("route"));
        $currLang = $route[0];
        if (in_array($currLang, config("lang.available_languages"))) {
            $route[0] = $lang;
            dd($lang, implode("/", $route));
            return redirect(implode("/", $route));
        }
    }
}
