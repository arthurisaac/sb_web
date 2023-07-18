<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Category;
use App\Models\Experience;
use App\Models\ExperienceItem;
use App\Models\ImagesBox;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boxes = Box::query()->get();
        return view("boxes.index", compact('boxes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $experiences = Experience::all();

        return view("boxes.create", compact("categories", "experiences"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "category" => "required",
            "partner" => "required",
            "name" => "required",
            "price" => "required",
            "validity" => "required",
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'images' => 'required',
            'experiences' => 'required'
        ]);

        $path = $request->file('image')->store('images', 'public');

        $data = new Box([
            'category' => $request->get("category"),
            'partner' => $request->get("partner"),
            'user' => auth()->user()->id,
            'name' => $request->get("name"),
            'price' => $request->get("price"),
            'discount' => $request->get("discount"),
            'discount_code' => $request->get("discount_code"),
            'min_person' => $request->get("min_person"),
            'max_person' => $request->get("max_person"),
            'start_time' => $request->get("start_time"),
            'end_time' => $request->get("end_time"),
            'validity' => $request->get("validity"),
            'description' => $request->get("description"),
            'must_know' => $request->get("must_know"),
            'is_inside' => $request->get("is_inside"),
            'country' => $request->get("country"),
            'image' => $path
        ]);
        $data->save();

        foreach ($request->file('images') as $key => $file) {
            echo $file;
            $image = $file->store('images', 'public');
            $ib = new ImagesBox([
                'box' => $data->id,
                'image' => $image
            ]);
            $ib->save();
        }

        if ($request->get('experiences')) {
            foreach ($request->get('experiences') as $exp) {
                $expItem = new ExperienceItem([
                    'box' => $data->id,
                    'experience' => $exp
                ]);
                $expItem->save();
            }
        }

        return redirect()->back()->with("success", "Box enregistré avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show(Box $box)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Box $box)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Box $box)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Box $box)
    {
        //
    }
}
