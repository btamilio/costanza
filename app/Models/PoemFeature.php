<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Models\Feature;
use App\Models\FeatureType;

 

class PoemFeature extends Model
{
    use SoftDeletes;

    public $table = 'poem_feature';


    public function feature()
    {
        return $this->hasOne(Feature::class, 'id', 'feature_id');
    }



 
}