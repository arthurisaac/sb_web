<?php

namespace App\Http\Controllers;

use App\Models\AccountTransaction;
use App\Models\Category;
use App\Models\User;
use App\Models\UserSubAccount;
use App\Models\UserTransfer;
use Illuminate\Http\Request;

class UserSubAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->with('roles')
            ->with('SubAccounts')
            ->get();
        return view('user-account.index', compact('users'));
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
            'user' => 'required|numeric',
            'category' => 'required|numeric',
            'target' => 'required|numeric',
        ]);
        $account = new UserSubAccount([
           'category' => $request->get('category'),
           'user' => $request->get('user'),
           'target' => $request->get('target'),
           'solde' => 0,
        ]);
        $account->save();
        return redirect()->back()->with('success', 'Sous compte ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categories = Category::query()->get();
        $user = User::query()->with('SubAccounts')->find($id);
        $transferts = AccountTransaction::query()->where('user', $id)->get();
        $userTransferts = UserTransfer::query()
            ->with('User')
            ->with('CreatedBy')
            ->where('user', $id)
            ->get();
        return view('user-account.show', compact('user', 'categories', 'transferts', 'userTransferts'));
    }

    public function editUserAccount(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'solde' => 'required|numeric',
        ]);
        $user = User::query()->with('SubAccounts')->find($request->user);
        if ($user) {
            $user->account = $request->get('solde');
            $user->save();
        }
        return redirect()->back()->with('success', 'Enregistré avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserSubAccount $userSubAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserSubAccount $userSubAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sub = UserSubAccount::query()->find($id);
        if ($sub) {
            $user = User::query()->find($sub->user);
            if ($user) {
                $user->account = $user->account + $sub->solde;
                $user->save();
            }
            $sub->delete();
        }
        return redirect()->back()->with('success', 'Supprimé avec succès');
    }
}
