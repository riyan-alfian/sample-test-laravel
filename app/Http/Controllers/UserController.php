<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\UserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function createUser(Request $request, UserService $service)
    {
        return response()->json($service->createUser($request));
    }
}
