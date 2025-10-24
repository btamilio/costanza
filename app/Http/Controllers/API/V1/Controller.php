<?php

namespace App\Http\Controllers\API\V1;

//TODO: finish the api

class Controller extends \App\Http\Controllers\Controller
{
    /**
     * Generates a failure response with optional error and notice information.
     *
     * @param mixed|null $error The error message or data to be included in the response.
     * @param string|null $notice Additional notice or message to be included in the response.
     * @param int $status The HTTP status code for the response (default: 200).
     * @return \Illuminate\Http\JsonResponse The JSON response containing the failure result and optional error/notice information.
     */
    public function failure($error = NULL, $notice = NULL, $status = 200)
    {
        $resp = ["result" => "failure"];

        if (! is_null($error))
            $resp["errors"] = $error;

        if (! is_null($notice))
            $resp["notice"] = $notice;

        return response()->json($resp, $status)->send();
    }


    /**
     * Generates a success response with optional data and notice information.
     *
     * @param mixed|null $data The data to be included in the response.
     * @param string|null $notice Additional notice or message to be included in the response.
     * @param int $status The HTTP status code for the response (default: 200).
     * @return \Illuminate\Http\JsonResponse The JSON response containing the success result and optional data/notice information.
     */
    public function success($data = NULL, $notice = NULL, $status = 200)
    {

        $resp = ["result" => "success"];

        if (! is_null($data))
            $resp["data"] = $data ?? [];

        if (! is_null($notice))
            $resp["notice"] = $notice;

        return response()->jsonPretty($resp, $status)->send();
    }





}
