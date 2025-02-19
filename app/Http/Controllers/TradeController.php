<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{
    public function index()
    {
        return view('trades.index');
    }

    public function create(Item $item, User $user)
    {
        $quantity = $item->users()->where('users.id', $user->id)->first()->pivot->quantity;
        return view('trades.create', compact('item', 'user', 'quantity'));
    }

    public function show(Trade $trade)
    {
        return view('trades.show', compact('trade'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiving_user_id' => 'required|exists:users,id',
            'receiving_item_id' => 'required|exists:items,id',
            'sending_item_id' => 'required|exists:items,id',
            'receiving_quantity' => 'required|numeric',
            'sending_quantity' => 'required|numeric',
        ]);

        Trade::create([
            'sending_user_id' => Auth::id(),
            'receiving_user_id' => $request->receiving_user_id,
            'receiving_item_id' => $request->receiving_item_id,
            'sending_item_id' => $request->sending_item_id,
            'receiving_quantity' => $request->receiving_quantity,
            'sending_quantity' => $request->sending_quantity,
        ]);

        return redirect()->route('trades.index')->with('success', 'Trade request created successfully.');
    }

    public function destroy(Trade $trade)
    {
        $trade->delete();
        return redirect()->route('trades.index')->with('success', 'Trade request deleted successfully.');
    }

    public function accept(Trade $trade)
    {
        if ($trade->receiving_user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $receivingItem = $trade->receivingItem;
        $sendingItem = $trade->sendingItem;
        $receivingQuantity = $trade->receiving_quantity;
        $sendingQuantity = $trade->sending_quantity;
        $receivingUser = $trade->receivingUser;
        $sendingUser = $trade->sendingUser;

        $sendingUserItem = $sendingUser->items()->find($sendingItem->id);
        $receivingUserItem = $receivingUser->items()->find($receivingItem->id);

        if (
            ($sendingUserItem && ($sendingUserItem->pivot->quantity - $sendingQuantity) < 0) ||
            ($receivingUserItem && ($receivingUserItem->pivot->quantity - $receivingQuantity) < 0) ||
            ($sendingUserItem && $sendingUserItem->pivot->quantity <= 0) ||
            ($receivingUserItem && $receivingUserItem->pivot->quantity <= 0)
        ) {
            abort(403, 'Not enough items to complete the trade.');
        }

        $sendingUserItem = $sendingUser->items()->find($sendingItem->id);
        if ($sendingUserItem) {
            $sendingUser->items()->updateExistingPivot($sendingItem->id, [
                'quantity' => $sendingUserItem->pivot->quantity - $sendingQuantity
            ]);
        } else {
            $sendingUser->items()->attach($sendingItem->id, [
                'quantity' => -$sendingQuantity
            ]);
        }

        $receivingUserItem = $receivingUser->items()->find($receivingItem->id);
        if ($receivingUserItem) {
            $receivingUser->items()->updateExistingPivot($receivingItem->id, [
                'quantity' => $receivingUserItem->pivot->quantity - $receivingQuantity
            ]);
        } else {
            $receivingUser->items()->attach($receivingItem->id, [
                'quantity' => -$receivingQuantity
            ]);
        }

        $receivingUserItem = $receivingUser->items()->find($sendingItem->id);
        if ($receivingUserItem) {
            $receivingUser->items()->updateExistingPivot($sendingItem->id, [
                'quantity' => $receivingUserItem->pivot->quantity + $sendingQuantity
            ]);
        } else {
            $receivingUser->items()->attach($sendingItem->id, [
                'quantity' => $sendingQuantity
            ]);
        }

        $sendingUserItem = $sendingUser->items()->find($receivingItem->id);
        if ($sendingUserItem) {
            $sendingUser->items()->updateExistingPivot($receivingItem->id, [
                'quantity' => $sendingUserItem->pivot->quantity + $receivingQuantity
            ]);
        } else {
            $sendingUser->items()->attach($receivingItem->id, [
                'quantity' => $receivingQuantity
            ]);
        }

        $trade->update(['accepted' => 'accepted']);

        return redirect()->route('trades.index')->with('success', 'Trade request accepted successfully.');
    }

    public function deny(Trade $trade)
    {
        $this->authorize('update', $trade);

        if ($trade->receiver_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $trade->update(['accepted' => 'declined']);
        return redirect()->route('trades.index')->with('success', 'Trade request denied successfully.');
    }
}
