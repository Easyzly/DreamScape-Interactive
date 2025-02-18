<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ItemsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $items = Item::query()
            ->with('rarity', 'type', 'users')
            ->withSum('users as total_quantity', 'user_item.quantity');

        if ($this->search) {
            $items->where('name', 'like', '%' . $this->search . '%');
        }

        $items->orderBy('total_quantity', 'desc');
        $items = $items->paginate($this->perPage);

        return view('livewire.items-table', compact('items'));
    }
}
