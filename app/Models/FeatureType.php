<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 

use App\Models\Poem;
use App\Models\Feature;



class FeatureType extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    public $table   = 'features_types';

 


    public function features()
    {
        return $this->hasMany(Feature::class)->orderBy("sort_order")->orderBy("label")->orderBy("name");
    }
}
