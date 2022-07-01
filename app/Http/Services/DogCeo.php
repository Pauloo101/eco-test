<?php

namespace App\Http\Services;

use App\Models\Breed;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class DogCeo{
    const BASE_URL = "https://dog.ceo/api";
    const REDIS_ALL_BREEDS = "REDIS_ALL_BREEDS";
    const REDIS_ALL_BREEDS_UPDATE = "REDIS_ALL_BREEDS_UPDATE";
    public static function getAllBreeds(){
        $checkLastUpdate = Redis::get(SELF::REDIS_ALL_BREEDS_UPDATE);
        if(!$checkLastUpdate){
            $request = Http::get(SELF::BASE_URL."/breeds/list/all");
            if($request->json()["status"] == "success"){
                // update database records ... ideally with a background job ...
                $response = $request->json();
                Redis::set(SELF::REDIS_ALL_BREEDS_UPDATE,"update",'EX', 86400);
                Redis::set(SELF::REDIS_ALL_BREEDS,json_encode($response["message"]));
                Breed::createOrUpdateBreeeds($response["message"]);
            }
        }
        return Breed::all();
    }

    public static function getImageOfSpecficBreed(Breed $breed){
        $request = Http::get(SELF::BASE_URL."/breed/{$breed->name}/images");
        $response = $request->json();
        Log::info($response);
    }

    public static function getRandomImage(){
        $request = Http::get(SELF::BASE_URL."/breeds/image/random");
        $response = $request->json();
        Log::info($response);
    }

}


