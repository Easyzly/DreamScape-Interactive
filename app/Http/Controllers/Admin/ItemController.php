<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function indexGiver()
    {
        $users = User::all();
        $items = Item::all();

        return view('admins.items-giver.index', compact('users', 'items'));
    }

    public function storeGiver(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|numeric',
        ]);

        $user = User::find($request->user_id);

        if ($user->items()->where('item_id', $request->item_id)->exists()) {
            $user->items()->updateExistingPivot($request->item_id, [
                'quantity' => $user->items()->where('item_id', $request->item_id)->first()->pivot->quantity + $request->quantity
            ]);
        } else {
            $user->items()->attach($request->item_id, ['quantity' => $request->quantity]);
        }

        return redirect()->route('admins.items-giver.index')->with('success', 'Item created successfully');
    }
}
