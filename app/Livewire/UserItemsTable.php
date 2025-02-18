<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class UserItemsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $user = auth()->user();
        $items = $user->items();

        if ($this->search) {
            $items->where('name', 'like', '%' . $this->search . '%');
        }

        $items->with('rarity', 'type');
        $items->orderBy('created_at', 'desc');
        $items = $items->paginate($this->perPage);

        return view('livewire.user-items-table', compact('items'));
    }
}
