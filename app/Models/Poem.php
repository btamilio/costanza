<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Feature;
use App\Models\PoemFeature;
use App\Models\FeatureType;
use App\Actions\Poem\GeneratePrompt;

 

class Poem extends Model
{
    use SoftDeletes;

    public $table = 'poems';

    protected $fillable = [
        'user_id',
        'lineation',
        'prompt',
        'topic'
    ];
 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'poem_feature');
    }

    public function features_by_type(bool $use_prompt_label = false)
    {
        $by_type = [];
 
        // get all features with their types, and group them by type.
        foreach ($this->features()->with('featureType')->get() ?? [] as $feature) 
        {
                
                $label = ($use_prompt_label)
                    ? ($feature->featureType->prompt_label ?? $feature->featureType->label ?? $feature->featureType->name)
                    : ($feature->featureType->label ?? $feature->featureType->name);
        
                $by_type[$label][] = $feature;
        }

        return $by_type;  
    }
 

}