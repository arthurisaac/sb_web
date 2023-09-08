<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = FAQ::query()->get();
        return view('faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("faq.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'response' => 'required',
        ]);
        $data = new FAQ([
            'question' => $request->get('question'),
            'response' => utf8_encode($request->get('response')),
        ]);
        $data->save();

        return redirect()->back()->with('success', 'Enregistré avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(FAQ $fAQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faq = FAQ::query()->findOrFail($id);
        return view("faq.edit", compact("faq", "id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'response' => 'required',
        ]);

        $faq = FAQ::query()->findOrFail($id);
        $faq->question = $request->get("question");
        $faq->response = $request->get("response");
        $faq->save();

        return redirect()->back()->with('success', 'Mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq = FAQ::query()->find($id);
        if ($faq) {
            $faq->delete();
        }
        return redirect()->back()->with('success', 'Supprimé avec succès');
    }
}
