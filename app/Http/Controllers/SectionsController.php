<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\SectionItem;
use App\Models\Sections;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Sections::query()->get();
        $boxes = Box::query()->get();
        return view("sections.index", compact("sections", "boxes"));
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
            "title" => 'required',
            "boxes" => 'required'
        ]);

        $boxes = $request->get("boxes");

        $section = new Sections([
            'title' => $request->get('title')
        ]);
        $section->save();

        foreach ($boxes as $box) {
            $item = new SectionItem([
                'section' => $section->id,
                'box' => $box
            ]);
            $item->save();
        }

        //dd($request->get("boxes"));

        return redirect()->back()->with("success", "Section ajouté avec succès");

    }

    /**
     * Display the specified resource.
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $section = Sections::query()->with("Boxes")->find($id);
        $boxes = Box::query()->get();

        return view("sections.edit", compact("section", "boxes"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sections $section)
    {
        //$section = Sections::query()->with("Boxes")->find($sections->id);

        $request->validate([
            "title" => 'required',
            "boxes" => 'required'
        ]);

        $boxes = $request->get("boxes");

        $items = SectionItem::query()->where("section", $section->id)->get();
        foreach ($items as $item) {
            $item->delete();
        }

        foreach ($boxes as $box) {
            $item = new SectionItem([
                'section' => $section->id,
                'box' => $box
            ]);
            $item->save();
        }

        $section->title = $request->get("title");
        $section->save();

        return redirect()->back()->with("success", "Enregistré avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Sections::query()->find($id);
        if ($data) {
            $data->delete();
        }

        return redirect()->back()->with("success", "Enregistré avec succès");
    }
}
