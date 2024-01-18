<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupTurn;
use Illuminate\Http\Request;

class GroupTurnController extends Controller
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
            'start' => 'required|date',
            'end' => 'required|date',
            'group' => 'required|numeric',
        ]);
        $group = Group::query()->find($request->get('group'));
        if ($group) {
            $turn = new GroupTurn([
                'group' => $request->get('group'),
                'name' => $request->get('name'),
                'start' => $request->get('start'),
                'end' => $request->get('end'),
                'subscription' => $group->subscription,
                'description' => $request->get('description'),
            ]);
            $turn->save();
        }

        return redirect()->back()->with('success', 'Enregistré avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupTurn $groupTurn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupTurn $groupTurn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupTurn $groupTurn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $turn = GroupTurn::query()->find($id);
        if ($turn) {
            $turn->delete();
        }
        return redirect()->back()->with('success', 'Supprimé avec succès');
    }
}
