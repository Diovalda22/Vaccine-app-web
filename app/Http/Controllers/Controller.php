<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function success($message = 'Success', $data = null, $code = 200) {
        if($data == null ) return response()->json(['messages' => $message], $code);
        return response()->json(['messages' => $message, 'data' => $data], $code);
    }

    public function failed($message = 'failed', $data = null, $code = 400) {
        if($data == null ) return response()->json(['messages' => $message], $code);
        return response()->json(['messages' => $message, 'data' => $data], $code);
    }
}
