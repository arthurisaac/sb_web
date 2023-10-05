<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->get();
        $subCategories = SubCategory::query()->with("Items")->get();
        return view('sub-category.index', compact('subCategories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $boxes = Box::query()->get();
        $subCategories = SubCategory::query()->get();

        return view('sub-category.create', compact("boxes", "subCategories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $path =  "";
        if ($request->file('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        $sub = new SubCategory([
            'category' => $request->get('category'),
            'title' =>  $request->get('title'),
            'description' => $request->get('description'),
            'image' =>  $path,
        ]);
        $sub->save();

        return redirect()->back()->with('success', 'Enregistré avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = SubCategory::query()->with("Items")->find($id);
        $subCategories = SubCategory::query()->get();
        $boxes = Box::query()->get();
        return view("sub-category.edit", compact("category", "subCategories", "boxes"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = SubCategory::query()->find($id);

        if ($data) {
            $data->title = $request->get('title');
            $data->description = $request->get('description');
            if ($request->file('image')) {
                $data->image = $request->file('image')->store('images', 'public');
            }
            $data->save();
        }

        return redirect()->back()->with("success", "Catégorie modifié avec succès");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
