<?php

namespace App\Http\Controllers\Web;

 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Feature;
use App\Models\FeatureType;
use App\Models\Poem;


class HomeController extends Controller
{


    public function index(Request $request)
    {
        $featureTypes = FeatureType::query()
            ->where('hidden', '!=', 1)
            ->orderBy('sort_order')
            ->orderBy('label')
            ->with(['features' => function ($query) {
                $query->orderBy('sort_order')
                    ->orderBy('label')
                    ->orderBy('name');
            }])
            ->get();

        $adjectiveType = $featureTypes->first(function ($type) {
            $descriptor = strtolower(trim(($type->name ?? '') . ' ' . ($type->label ?? '')));

            return $descriptor !== '' && str_contains($descriptor, 'adject');
        });

        $adjectiveFeature = $adjectiveType?->features
            ->filter(fn ($feature) => (int) ($feature->hidden ?? 0) !== 1 && (filled($feature->label) || filled($feature->name)))
            ->shuffle()
            ->first();

        return view('home', [
            "feature_types"         =>  $featureTypes->toArray(),
            "inspiration_adjective" => $adjectiveFeature?->label ?? $adjectiveFeature?->name ?? 'amazing',
            'prompt_prompt'         => "Do you want to build a poem?"  // TODO: make this dynamic
        ]);
    }


 
}
