<?php

namespace App\Actions\Poem;

use App\Models\FeatureType;
use App\Models\Poem;

use Illuminate\Support\Arr;

class GeneratePrompt
{

    // leaving this as an Action for now, though it could easily be a method 
    // on the Poem model, or part of Jobs/GeneratePoem 

    public function execute(Poem $poem)
    {
        $features_by_type = $poem->features_by_type(use_prompt_label: true);

        $prompt = [];   
        foreach ($features_by_type as $k => $v) {
            if (!empty($v))
               $prompt[$k] = $v[0]["name"];
        }

        if (!empty($poem->topic))
            $prompt["topic"] = $poem->topic;
    
        $instructions = config('services.openai.instruction');
    
        // TODO: address in a later release
        return $instructions[0].json_encode($prompt).implode(" ", array_slice($instructions,1));
    }
}
