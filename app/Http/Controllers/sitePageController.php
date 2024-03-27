<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sitePageController extends Controller
{
    public function operation(){
        return view('Pages.operation');
    }
}
