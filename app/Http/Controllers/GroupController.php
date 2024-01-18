<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::query()
            ->with('GroupUsers')
            ->get();
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'target' => 'required',
            'subscription' => 'required',
            'rate' => 'required',
            'total_allowed' => 'required',
            'description' => 'required',
        ]);
        $group = new Group([
            'name' => $request->get('name'),
            'solde' => 0,
            'target' => $request->get('target'),
            'subscription' => $request->get('subscription'),
            'rate' => $request->get('rate'),
            'total_allowed' => $request->get('total_allowed'),
            'description' => $request->get('description'),
        ]);
        $group->save();
        return redirect()->back()->with('success', 'Enregistré avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $users = User::query()->get();
        return view('groups.edit', compact('group', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        return redirect()->back()->with('success', 'Modifié avec succès');
    }


    public function addMembers(Request $request)
    {
        $request->validate([
            'users' => 'required|array',
            'group' => 'required|numeric',
        ]);
        $group = Group::query()->find($request->get('group'));
        $users = $request->get('users');
        if ($group) {
            foreach ($users as $item) {
                $userExist = GroupUser::query()
                    ->where("user", $item)
                    ->where("group", $group->id)
                    ->first();
                if (!$userExist) {
                    $groupUser = new GroupUser([
                        'group' => $group->id,
                        'user' => $item,
                    ]);
                    $groupUser->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $group = Group::query()->find($id);
        if ($group) {
            $groupUsers = GroupUser::query()->where('group', $group->id)->get();
            foreach ($groupUsers as $groupUser)
                $groupUser->delete();
            $group->delete();
        }

        return redirect()->back()->with('success', 'Supprimé avec succès');
    }
}
