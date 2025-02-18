<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{
    public function index()
    {
        return view('trades.index');
    }

    public function show(Trade $trade)
    {
        return view('trades.show', compact('trade'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        Trade::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
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
        $this->authorize('update', $trade);

        if ($trade->receiver_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
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
