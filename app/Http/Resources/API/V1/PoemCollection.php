<?php

namespace App\Http\Resources\API\V1;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\V1\PoemResource;

class PoemCollection extends JsonResource
{
    public function toArray($request)
    {
 
        return [
            'result' => 'success',
  
            'data' => [
                'total' => $this->resource->total,
                'items' => PoemResource::collection($this->resource->items),
            ],
        
        ];
    }
}
