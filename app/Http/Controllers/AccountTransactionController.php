<?php

namespace App\Http\Controllers;

use App\Models\AccountTransaction;
use App\Models\User;
use App\Models\UserSubAccount;
use App\Models\UserTransfer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AccountTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transferts = AccountTransaction::query()
            ->with('User')
            ->with('SubAccount')
            ->get();
        $users = User::query()
            ->with('SubAccounts')
            ->get();
        return view('account-transactions.index', compact('users', 'transferts'));
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
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|numeric',
            'amount' => 'required|numeric',
            'subAccount' => 'required',
        ]);

        // Check if user balance is not enough for transfer
        $user = User::query()->find($request->get('user'));
        if ($user && $user->account >= $request->get('amount')) {

            // Edit sub-account balance
            $subAccount = UserSubAccount::query()->find($request->get('subAccount'));

            if ($subAccount) {
                // Save new amount to sub-account
                $subAccount->solde = $subAccount->solde + $request->get('amount');
                $subAccount->save();

                // Save new amount to user
                $user->account = $user->account - $request->get('amount');
                $user->save();
            }

            $transfer = new AccountTransaction([
                'user' => $request->get('user'),
                'amount' => $request->get('amount'),
                'subAccount' => $request->get('subAccount'),
            ]);
            $transfer->save();

        } else {
            throw ValidationException::withMessages([
                'error' => 'Le compte n\'a pas assez d\'argent'
            ]);
        }


        return redirect()->back()->with('success', 'Enregistré avec succé');
    }

    public function transfertToAccount(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountTransaction $accountTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountTransaction $accountTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountTransaction $accountTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountTransaction $accountTransaction)
    {
        //
    }
}
