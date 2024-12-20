<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
  public function sendResponse($result, $message)
  {
    $response = [
      'ok' => true,
      'data' => $result,
      'message' => $message
    ];

    return response()->json($response, 200);
  }

  public function sendError($error, $errorMessages = [], $code = 404)
  {
    $response = [
      'ok' => false,
      'message' => $error
    ];

    if(!empty($errorMessages)) {
      $response['data'] = $errorMessages;
    }

    return response()->json($response, $code);
  }
}
