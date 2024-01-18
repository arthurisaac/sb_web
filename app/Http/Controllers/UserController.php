<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->with("roles")
            ->get();
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::query()->get();
        return view("users.create", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required',
            'country' => 'required',
            'type' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $path = '';
        if ($request->file('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'country' => $request->country,
            'type' => $request->type,
            'avatar' => $path,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return redirect()->back()->with('success', 'Enregistré avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::query()->find($id);
        return view("users.show", compact("user"));
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
        $user = User::query()->find($id);
        $user?->delete();
        return redirect()->route("users.index")->with("success", "Supprimé avec succès");
    }
}
