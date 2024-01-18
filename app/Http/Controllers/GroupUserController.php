<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Http\Request;

class GroupUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::query()
            ->with('GroupUsers')
            ->get();
        return view('group-account.index', compact('groups'));
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
    public function show($id)
    {
        $group = Group::query()->findOrFail($id);
        $users = User::query()->get();
        return view('group-account.show', compact('group', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupUser $groupUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupUser $groupUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupUser $groupUser)
    {
        //
    }
}
