<?php

namespace App\Http\Controllers;

use App\Models\Park;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function assoicateUserToType(Request $request, $user_id){
        if($request->type == 'breed'){
            return $this->assoicateUserToBreed($user_id, $request->type_id);
        }else{
            return $this->assoicateBreedToPark($user_id, $request->type_id);
        }
    }

    public function assoicateUserToBreed($user_id, $breed_id){
        $user = User::find($user_id);
        $user->breeds()->sync([$breed_id]);
        return response()->json(["msg"=>"User assoicated to breed", "status"=>"success"]);
    }
    public function assoicateUserToPark($user_id, $park_id){
        $user = User::find($user_id);
        $user->parks()->sync([$park_id]);
        return response()->json(["msg"=>"User assoicated to Park", "status"=>"success"]);
    }
    public function assoicateBreedToPark(Request $request, $park_id){
        $park = Park::find($park_id);
        $park->breeds()->sync([$park_id]);
        return response()->json(["msg"=>"Park assoicated to breed", "status"=>"success"]);
    }
}
