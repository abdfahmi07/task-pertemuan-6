<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($results, $message = "Success", $responseCode = 200) {
        $response = [
            "success" => true,
            "data" => $results,
            "message" => $message
        ];

        return response()->json($response, $responseCode);
    }

    public function sendError($error, $responseCode = 404) {
        $response = [
            "success" => false,
            "message" => $error
        ];

        return response()->json($response, $responseCode);
    }
}