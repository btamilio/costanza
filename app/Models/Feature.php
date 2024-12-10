<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Poem;
use App\Models\FeatureType;



class Feature extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    public $table   = 'features';
  
    
        
    public function poem()
    {
        return $this->belongsTo(Poem::class);
    }

    public function poems()
    {
        return $this->belongsToMany(Poem::class, 'poem_feature');
    }

    public function featureType()
    {
        return $this->belongsTo(FeatureType::class);
    }






}