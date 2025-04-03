<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

class UserController extends Controller
{
    public function users()
    {
        return response()->json([
            'users' => [
                ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
                ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
                ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com'],
            ]
        ]);
    }
}
