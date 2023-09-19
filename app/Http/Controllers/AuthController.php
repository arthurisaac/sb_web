<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\User;
use App\Models\UserDeleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('API Token')->accessToken;

            return response()->json(['token' => $token, 'user' => auth()->user()]);
        }

        return response()->json(['error' => 'Unauthorized', 'message' => 'Email ou mot de passe incorrecte'], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'country' => $request->country,
            'countryCode' => $request->countryCode,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
        ], 201);
    }

    public function deleteUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::query()->find($request->get("user"));

        if ($user) {
            $userDeleted = new UserDeleted([
                'id_user' => $user->id,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'email' => $user->email,
                'mobile' => $user->mobile,
                'country' => $user->country,
                'countryCode' => $user->countryCode,
                'active' => $user->active,
                'password' => $user->password,
            ]);
            $userDeleted->save();

            $user->delete();
        }

        return response()->json([
            'message' => 'User deleted successfully.',
        ], 201);
    }

}
