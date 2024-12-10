<?php

namespace App\Http\Controllers\API\V1;



class Controller extends \App\Http\Controllers\Controller
{


    public function failure($error = NULL, $notice = NULL, $status = 200)
    {

        $resp = ["result" => "failure"];

        if (! is_null($error))
            $resp["errors"] = $error;

        if (! is_null($notice))
            $resp["notice"] = $notice;


        return response()->json($resp, $status)->send();

    }


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
