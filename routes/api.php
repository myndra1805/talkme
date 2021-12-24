<?php

use Illuminate\Support\Facades\Route;
use App\Location;
use App\User;
use App\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/location", function(Request $request){
    $user = User::where("id", $request->id)->first(); //AMBIL USER YANG SEDANG LOGIN
    //SIMPAN DATA KE TABLE LOCATION MELALUI USER
    if(count($user->locations()->get()) > 0){
        $user->locations()->where("user_id", $user->id)->update([
            "lang" => $request->lng,
            "lat" => $request->lat
        ]);
    }else{
        $user->locations()->create([
            "lang" => $request->lng,
            "lat" => $request->lat
        ]);
    }
    return ["status" => "Success"];
});

Route::get("/location", function(){ 
    $users = User::all();
    $locations = Location::all();
    return [
        "users" => $users,
        "locations" => $locations
    ];
});

Route::get("/users", function(){
    $data = [];
    $users = User::all();
    foreach($users as $user){
        $data[] = [
            "user" => $user,
            "location" => $user->locations()->first()
        ];
    }
    return $data;
});


Route::get("/messages/{user_id}/{to}", function($user_id, $to){
    $messages = Message::where([
        ["user_id", $user_id],
        ["to", $to]
    ])->orWhere([
        ["user_id", $to],
        ["to", $user_id]
    ])->get();
    return $messages;
});

Route::post("/messages", function(Request $request){
    $user = User::where("id", $request->user_id)->first(); //AMBIL USER YANG SEDANG LOGIN
    //SIMPAN DATA KE TABLE MESSAGES MELALUI USER
    $message = $user->messages()->create([
        'message' => $request->message,
        'to' => $request->to
    ]);
    broadcast(new MessageSent($message, $user))->toOthers();
    return response()->json([
        'status' => "Success",
        "to" => $request->to,
        "user_id" =>$request->user_id
    ]);
});