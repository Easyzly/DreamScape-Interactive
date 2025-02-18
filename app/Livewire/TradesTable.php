<?php

namespace App\Livewire;

use App\Models\Trade;
use Livewire\Component;
use Livewire\WithPagination;

class TradesTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $trades = Trade::query();

        $trades->where(function ($query) {
            $query->where('sender_id', auth()->id())
                ->orWhere('receiver_id', auth()->id());
        });

        if ($this->search) {
            $trades->whereHas('sender', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

            $trades->orWhereHas('receiver', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

            $trades->orWhereHas('item', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        }

        $trades->with('sender', 'receiver', 'item');
        $trades = $trades->paginate($this->perPage);

        return view('livewire.trades-table', compact('trades'));
    }
}
