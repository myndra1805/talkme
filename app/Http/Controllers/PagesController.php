<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function home(){
        return view("home", [
            "id" => Auth::user()->id
        ]);
    }

    public function about(){
        $breadcrumb = [
            "text" => "About",
            "disabled" => true,
            "href" => "/about"        
        ];
        return view("about", [
            "breadcrumb" => json_encode($breadcrumb)
        ]);
    }

    public function distance(){
        $breadcrumb = [
            "text" => "Distance",
            "disabled" => true,
            "href" => "/distance"        
        ];
        return view("distance", [
            "breadcrumb" => json_encode($breadcrumb)
        ]);
    }
}
