<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{

    public function index(Request $request) {
        $validator = Validator::make($request->all(), [
            "user" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $favorites = Favorite::with("Box")->where("user", $request->get("user"))->get();

        return new ApiResource($favorites);
    }

    public function store(Request $request) {
        $request->validate([
            "box" => "required",
            "user" => "required",
        ]);

        $favorites = Favorite::query()
            ->where("box", $request->get("box"))
            ->where("user", $request->get("user"))
            ->first();

        if ($favorites) {
            $favorites->delete();
        } else {
            $favorites = new Favorite([
               "box" => $request->get("box"),
               "user" => $request->get("user"),
            ]);
            $favorites->save();
        }

        return response()->json([
            'message' => 'Favori enregistre.',
        ], 201);
    }
}
