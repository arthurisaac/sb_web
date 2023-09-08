<?php

namespace App\Http\Controllers;

use App\Models\SubCategoryItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SubCategoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'sub' => 'required',
            'boxes' => 'required',
        ]);

        $boxes = $request->get('boxes');

        foreach ($boxes as $box) {
            $item = new SubCategoryItem([
                'sub_category' => $request->get("sub"),
                'box' => $box
            ]);
            $item->save();
        }

        return redirect()->back()->with('success', 'Enregistré avec succès');
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
