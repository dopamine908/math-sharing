<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::guard('api')->user();
        return Response::json(
            [
                'user' => $user
            ]
        );
    }
}
