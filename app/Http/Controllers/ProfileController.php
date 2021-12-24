<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Location;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function index(){
        $breadcrumb = [
            "text" => "Profile",
            "disabled" => true,
            "href" => "/profile"        
        ];
        $user = Auth::user();
        return view("profile", [
            "user" => json_encode($user),
            "breadcrumb" => json_encode($breadcrumb)
        ]);
    }

    public function update(Request $request){
        $breadcrumb = [
            "text" => "Chat",
            "disabled" => true,
            "href" => "/chat"        
        ];
        $request->gender = $request->gender == 'Laki-Laki' ? 'l' : 'p';
        $user = User::where("id", $request->id)->first();
        if($request->new_password != null && $request->old_password != null){
            if(Hash::check($request->old_password, $user->password)){
                $user->update([
                    "name" => $request->name,
                    "gender" => $request->gender,
                    "birtday" => $request->birtday,
                    "password" => Hash::make($request->new_password),
                ]);
                return redirect("/profile")->with("status", "Data profile berhasil di upload");
            }else{
                return redirect("/profile")->with("error", "Password yang anda masukkan tidak sesuai");
            }
        }else if($request->new_password != null || $request->old_password != null){
            return redirect("/profile")->with("error", "Silakan masukkan password baru dan lama jika ingin mengubah password");
        }else{
            $user->update([
                "name" => $request->name,
                "gender" => $request->gender,
                "birtday" => $request->birtday,
            ]);
            return redirect("/profile")->with("status", "Data profile berhasil di upload");
        }
    }

    public function delete(Request $request){
        $user = User::where("id",  $request->id)->first();
        $location = Location::where("user_id",  $request->id)->first();
        $url = explode("/", $user->foto);
        $url = "public/" . $url[2] . "/" . $url[3];
        Storage::disk("local")->delete($url);
        $user->delete();
        $location->delete();
        return redirect("/profile");
    }

    public function foto(Request $request){
        $file = $request->file("foto");
        $ext = $file->getClientOriginalExtension();
        $id = Auth::user()->id;
        $name = $id . "." .$ext;
        $path = $file->storeAs("public/profile", $name);
        User::where('id', $id)->first()->update([
            "foto" => Storage::url($path)
        ]);
        return redirect("/profile");
    }

    public function location(Request $request){
        // $user = Auth::user();
        // if(count($user->locations()->get()) > 0){
        //     $user->locations()->where("user_id", $user->id)->update([
        //         "lang" => $request->lng,
        //         "lat" => $request->lat
        //     ]);
        // }else{
        //     $user->locations()->create([
        //         "lang" => $request->lng,
        //         "lat" => $request->lat
        //     ]);
        // }
        // return [
        //     "status" => "Success"
        // ];
    }

    public function getLocation(){ 
        // $users = User::all();
        // $locations = Location::all();
        // return [
        //     "users" => json_encode($users),
        //     "locations" => json_encode($locations)
        // ];
    }
}
