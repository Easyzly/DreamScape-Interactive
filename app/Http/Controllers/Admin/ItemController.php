<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Rarity;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('admins.items.index');
    }

    public function show(Item $item)
    {
        return view('admins.items.show', compact('item'));
    }

    public function create()
    {
        $types = Type::all();
        $rarities = Rarity::all();

        return view('admins.items.create', compact('types', 'rarities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rarity_id' => 'required|exists:rarities,id',
            'type_id' => 'required|exists:types,id',
            'power' => 'required|numeric',
            'speed' => 'required|numeric',
            'durability' => 'required|numeric',
            'magic' => 'required|numeric',
        ]);

        Item::create($request->all());

        return redirect()->route('admins.items.index')->with('success', 'Item created successfully');
    }

    public function edit(Item $item)
    {
        $types = Type::all();
        $rarities = Rarity::all();

        return view('admins.items.edit', compact('item', 'types', 'rarities'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'rarity_id' => 'required|exists:rarities,id',
            'type_id' => 'required|exists:types,id',
            'power' => 'required|numeric',
            'speed' => 'required|numeric',
            'durability' => 'required|numeric',
            'magic' => 'required|numeric',
        ]);

        $item->update($request->all());

        return redirect()->route('admins.items.index')->with('success', 'Item updated successfully');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('admins.items.index')->with('success', 'Item deleted successfully');
    }

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
