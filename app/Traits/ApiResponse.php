<?php

namespace App\Traits;

trait ApiResponse
{
    public function APIResponse($data = [], $code = 200, $message= "Exito"){
        return response()->json(array("data" => $data, "code" => $code, "message" => $message));
    }
}