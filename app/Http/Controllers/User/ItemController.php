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

    public function show(Item $item)
    {
        return view('users.items.show', compact('item'));
    }


    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('user.items.index')->with('success', 'Item deleted successfully');
    }
}
