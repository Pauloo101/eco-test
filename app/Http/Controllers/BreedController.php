<?php

namespace App\Http\Controllers;

use App\Http\Services\DogCeo;
use App\Models\Breed;
use Illuminate\Http\Request;

class BreedController extends Controller
{
    public function getAllBreeds(Request $request)
    {
        return response()->json(["breeds"=>DogCeo::getAllBreeds(), "status"=>"success"]);
    }
    public function getBreedById(Request $request, $breed_id){
        try {
            $breed = Breed::with(['users','parks'])->findOrFail($breed_id);
            return response()->json([
                "breed"=>$breed,
                "status"=>"success"]);
        } catch (\Throwable $th) {
            return response()->json(["breed"=>null, "status"=>"failed", "message"=>"Breed not found"]);
        }
    }
    public function getRandomBreed(Request $request){
        return response()->json(["breed"=>Breed::inRandomOrder()->first(), "status"=>"success"]);
    }

    // get image by breed
}
