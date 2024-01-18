<?php

namespace App\Http\Controllers;

use App\Models\AccountTransaction;
use App\Models\Group;
use App\Models\GroupTransfer;
use App\Models\GroupTurn;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class GroupTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->with('SubAccounts')
            ->with('Groups')
            ->get();
        $transferts = GroupTransfer::query()
            ->with("User")
            ->with("Group")
            ->with("GroupTurn")
            ->get();

        return view('group-transactions.index', compact('users', 'transferts'));
    }

    public function groupTurns(Request $request) {
        $validator = Validator::make($request->all(), [
            'group' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Un ou plusieurs sont necessaire.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $turns = GroupTurn::query()
            ->where('group', $request->get('group'))
            ->get();

        return response()->json([
            'message' => 'Tour récupérer.',
            'turns' => $turns,
            'group' => $request->get('group')
        ], 201);
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
            'group' => 'required|numeric',
            'turns' => 'required|numeric',
        ]);

        // Check if user balance is not enough for transfer
        $user = User::query()->find($request->get('user'));
        if ($user && $user->account >= $request->get('amount')) {
            $group = Group::query()->find($request->get('group'));
            if ($group) {
                $group->solde = $group->solde + intval($request->get('amount'));
                $group->save();

                $user->account = $user->account - intval($request->get('amount'));
                $user->save();

                $transfer = new GroupTransfer([
                    'group' => $request->get('group'),
                    'group-turn' => $request->get('turns'),
                    'user' => $request->get('user'),
                    'amount' => $request->get('amount'),
                    'method' => $request->get('method'),
                ]);
                $transfer->save();
            } else {
                throw ValidationException::withMessages([
                    'error' => 'Le group n\'est pas disponible'
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'error' => 'Le compte n\'a pas assez d\'argent'
            ]);
        }

        return redirect()->back()->with('success', 'Enregistré avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(GroupTransfer $groupTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupTransfer $groupTransfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupTransfer $groupTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupTransfer $groupTransfer)
    {
        //
    }
}
