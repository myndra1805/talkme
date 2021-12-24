<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class MessangerController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function index(){
        $breadcrumb = [
            "text" => "Chat",
            "disabled" => true,
            "href" => "/chat"        
        ];
        return view("chat", [
            "breadcrumb" => json_encode($breadcrumb)
        ]);
    }

    public function detail($id){
        $breadcrumb =  [
            "text" => "Chat",
            "disabled" => true,
            "href" => "/chat"        
        ];
        $user = User::where("id", $id)->first();
        return view("detail-chat", [
            "breadcrumb" => json_encode($breadcrumb),
            "data" => [
                "user" => $user,
                "location" => $user->locations()->first(),
            ],
            "to" => $id,
            "id" => Auth::user()->id
        ]);
    }
}
