<?php
 
namespace App\Http\Resources\API\V1;
 
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
 
class PoemResource extends JsonResource
{
 
    public function toArray(Request $request): array
    {

        $features = [];
        foreach ($this->resource->features_by_type() as $k => $v)
        {
            $features[strtolower($k)] =  $v[0]->name;
        }

    

        return [
            'result' => 'success',
            'data' => [
                'poem' =>  [ 
                      "title"        => $this->resource->title,
                      "topic"        => $this->resource->topic,
                      "lineation"    => $this->resource->lineation,
                      "date"         => $this->resource->generated_at ?? $this->resource->updated_at,
                      "author"       => $this->resource->user->display_name ?? "Anonymous",
                      "authors_note" => $this->resource->authors_note ?? "",

                       $this->mergeWhen(!empty($features), $features),

                       $this->mergeWhen (!empty($this->resource->topic), [
                            "topic"       => $this->resource->topic,
                       ]),
              
                ]
            ],

        ];
    }
}