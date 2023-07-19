<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Box;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boxes = Box::query()->get();
        return new ApiResource($boxes);
    }

    public function showBoxOfACategory(Request $request)
    {
        $request->validate([
            "category" => "required",
        ]);
        $user = $request->get("user");

        $boxes = Box::with('images')
            ->with('favorites', function($q) use ($user) {
                $q->where('user', $user);
            })
            //->whereRelation("favorites", "user", $user)
            ->where("category", $request->get("category"))
            ->get();
        return new ApiResource($boxes);
    }

    public function search(Request $request) {
        $validator = Validator::make($request->all(), [
            "q" => "required",
        ]);
        $user = $request->get("user");

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $boxes = Box::with('images')
            ->with('favorites', function($q) use ($user) {
                $q->where('user', $user);
            })
            //->whereRelation("favorites", "user", $user)
            ->when($request->q,
                function (Builder $builder) use ($request) {
                    $builder->where('name', 'like', "%{$request->q}%")
                        ->orWhere('description', 'like', "%{$request->q}%");
                })
            ->get();
        return new ApiResource($boxes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
