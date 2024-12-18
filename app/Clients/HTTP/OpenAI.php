<?php

namespace App\Clients\HTTP;


use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

use App\Clients\HTTPClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Exception;

class OpenAI extends HTTPClient
{

    protected string $base_url;



    public function __construct(protected array $options = []) {
        $this->base_url = config("services.openai.base_url");
    }


    // "moderation" checks whether a given input text is likely to be offensive, hateful, or inappropriate.
    public function getModerationStatus(string $input, string $model = "omni-moderation-latest")
    {
        try {
            $response = $this->client("api")->post($this->base_url . "/v1/moderations", [
                "input" => $input
            ]);

            if (!$response->successful())
                throw new Exception();
        } catch (Exception $e) {
            return $this->onHttpError(__FUNCTION__, $e->getMessage() ?? $response?->status() ?? "");
        }

        $body = json_decode($response->body());
        return ($body->results[0]->flagged ?? TRUE) ? TRUE  : FALSE;
    }


    public function getChatCompletion(array $messages, string $model = "gpt-4")
    {

        try {
            $response = $this->client("api")->post($this->base_url . "/v1/chat/completions", [
                "model"    => $model,
                "messages" => $messages
            ]);

            if (!$response->successful())
                throw new Exception();
        
        } catch (Exception $e) {
            return $this->onHttpError(__FUNCTION__, ($e->getMessage() ?? ""));
        }

        return $response->body();
    }

    public function client(string $resource)
    {

        return $this->client  ?? parent::client($resource)->withHeaders([
            'OpenAI-Organization'   => config("services.openai.organization"),
            'OpenAI-Project'        => config("services.openai.project"),
        ])->withToken($this->getAuthToken($resource));
    }




    public function getAuthToken($resource = NULL)
    {
        return config("services.openai.token");
    }
}
