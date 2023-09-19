<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SliderMainPage;
use Illuminate\Http\Request;

class SliderMainPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = SliderMainPage::query()->get();
        $categories = Category::query()->get();

        return view("slider-main.index", compact('sliders', 'categories'));
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
            "type" => "required",
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $data = new SliderMainPage([
            "image" => $path,
            "type" => $request->get("type"),
            "type_id" => $request->get("type_id")
        ]);
        $data->save();

        return redirect()->back()->with("success", "Enregistré avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show(SliderMainPage $sliderMainPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SliderMainPage $sliderMainPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SliderMainPage $sliderMainPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = SliderMainPage::query()->find($id);
        if ($slider) {
            $slider->delete();
        }
        return redirect()->back()->with("succes", "Supprimé avec succès");
    }
}
