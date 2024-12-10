<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\FeatureType;

class PoemRequestResource extends JsonResource
{

    public function toArray(Request $request): array
    {


        $rules[$type->name] = ["sometimes", "nullable", "in:" . implode(",", collect($type->features->pluck("id"))->toArray())];

        return [
            'costanza_poem_request' => [

                    "title" => $this->resource->title,
                    "body"  => $this->resource->lineation,
                    "date"  => $this->resource->created_at,
                    "author" => $this->resource->user->display_name
                ]
            ];

    }
}
