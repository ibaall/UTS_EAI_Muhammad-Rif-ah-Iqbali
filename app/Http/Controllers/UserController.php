<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return response()->json(User::all());
    }

    public function show($id) {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                'status' => 'success',
                'data' => $user
            ]);
        }

        return response()->json(['message' => 'User not found'], 404);
    }


}
