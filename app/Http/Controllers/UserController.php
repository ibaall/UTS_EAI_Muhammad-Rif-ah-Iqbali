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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
        ]);

        $user = User::create($validated);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 201);
    }
    public function update(Request $request, $id)
{
    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $validated = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|email|unique:users,email,' . $id,
        'phone' => 'sometimes|required|string|max:20',
    ]);

    $user->update($validated);

    return response()->json([
        'status' => 'success',
        'data' => $user
    ]);

}
public function destroy($id)
{
    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $user->delete();

    return response()->json(['message' => 'User deleted successfully']);
}



}
