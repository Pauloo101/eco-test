<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'sub_breeds' => 'array',
        'images'=>'array'
    ];

    public function parks(){
        return $this->morphedByMany(Park::class, "breedable","breedable");
    }

    public function users(){ // users or owners
        return $this->morphedByMany(User::class, "breedable","breedable");
    }

    public static function createOrUpdateBreeeds($DogCeoResponse){
        foreach($DogCeoResponse as $breed => $sub_breeds){
            SELF::updateOrCreate(
                ["name" => $breed],
                ["sub_breeds" => $sub_breeds]
            );
        }
    }
    // handle delete breed
}
