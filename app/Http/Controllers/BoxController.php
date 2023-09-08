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
            'description' => utf8_encode($request->get("description")),
            'must_know' => utf8_encode($request->get("must_know")),
            'is_inside' => utf8_encode($request->get("is_inside")),
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
        $categories = Category::all();
        return view("boxes.edit", compact("box", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $box = Box::query()->find($id);

        if ($box) {

            $box->category = $request->get("category");
            $box->partner = $request->get("partner");
            $box->user = auth()->user()->id;
            $box->name = $request->get("name");
            $box->price = $request->get("price");
            $box->discount = $request->get("discount");
            $box->discount_code = $request->get("discount_code");
            $box->min_person = $request->get("min_person");
            $box->max_person = $request->get("max_person");
            $box->start_time = $request->get("start_time");
            $box->end_time = $request->get("end_time");
            $box->validity = $request->get("validity");
            $box->description = utf8_encode($request->get("description"));
            $box->must_know = utf8_encode($request->get("must_know"));
            $box->is_inside = utf8_encode($request->get("is_inside"));
            $box->country = $request->get("country");

            if ($request->file("image")) {
                $path = $request->file('image')->store('images', 'public');
                $box->image = $path;
            }

            $box->save();
        }

        return redirect()->back()->with("success", "Enregistré avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $box = Box::query()->find($id);
        if ($box) {
            $box->delete();
        }

        return redirect()->back()->with("success", "Enregistré avec succès");
    }
}
