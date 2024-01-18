<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserTransfer;
use Illuminate\Http\Request;

class UserTransferController extends Controller
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
            'user' => 'required',
            'amount' => 'required',
            'type' => 'required',
        ]);

        $user = User::query()->find($request->get('user'));
        if ($user) {
            $transfer = new UserTransfer([
                'user' => $request->get('user'),
                'created_by' => auth()->user()->id,
                'amount' => $request->get('amount'),
                'before_amount' => $user->account,
                'after_amount' => $user->account + intval($request->get('amount')),
                'method' => $request->get('method'),
            ]);
            $transfer->save();

            $user->account = $user->account + intval($request->get('amount'));
            $user->save();
        }

        return redirect()->back()->with('success', 'Enregistré avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserTransfer $userTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserTransfer $userTransfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserTransfer $userTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserTransfer $userTransfer)
    {
        //
    }
}
