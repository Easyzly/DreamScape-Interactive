<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('users.items.index');
    }

    public function create()
    {
        return view('users.items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rarity_id' => 'required|integer',
            'type_id' => 'required|integer',
            'power' => 'required|integer',
            'speed' => 'required|integer',
            'durability' => 'required|integer',
            'magic' => 'required|string',
        ]);

        $item = Item::create([
            'name' => $request->name,
            'rarity_id' => $request->rarity_id,
            'type_id' => $request->type_id,
            'power' => $request->power,
            'speed' => $request->speed,
            'durability' => $request->durability,
            'magic' => $request->magic,
        ]);

        return redirect()->route('items.index')->with('success', 'Item created successfully');
    }

    public function show(Item $item)
    {
        return view('users.items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('users.items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rarity_id' => 'required|integer',
            'type_id' => 'required|integer',
            'power' => 'required|integer',
            'speed' => 'required|integer',
            'durability' => 'required|integer',
            'magic' => 'required|string',
        ]);

        $item->update([
            'name' => $request->name,
            'rarity_id' => $request->rarity_id,
            'type_id' => $request->type_id,
            'power' => $request->power,
            'speed' => $request->speed,
            'durability' => $request->durability,
            'magic' => $request->magic,
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully');
    }
}
