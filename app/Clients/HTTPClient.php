<?php

namespace App\Clients;

 
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Exception;





abstract class HTTPClient
{

    protected mixed  $client = NULL;
    protected int    $cache_ttl = 300;



    public function __construct(protected array $options = []) {}



    public function client(string $resource)
    {

        try {
            return (! empty($this->client))
                ? $this->client
                : Http::acceptJson()
                    ->retry($this->options["max_retires"] ?? 5)
                    ->timeout($this->options["timeout"] ?? 30)
                    ->withoutRedirecting()
                    ->withOptions([
                        'connect_timeout' => $this->options["connect_timeout"] ?? 10,
                    ])
                    ->withUserAgent('BREN-WAS-HERE/1.0'); // &shrug; 
        } catch (Exception $e) {
            return Log::critical(__FUNCTION__ . " could not instantiate HTTP Client (MSG: " . ($e->getMessage() ?? "N/A") . ")");
        }
    }



    protected function onHttpError(string $caller, string $status, string $msg = NULL)
    {
        return Log::error($caller . " HTTP request error (HTTP {$status} | MSG: " . ($msg ?? "N/A") . ")");
    }

    public function getAuthToken($resource = NULL){}



}
