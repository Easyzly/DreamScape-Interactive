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
            $query->where('sending_user_id', auth()->id())
                ->orWhere('receiving_user_id', auth()->id());
        });

        if ($this->search) {
            $trades->whereHas('sendingUser', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

            $trades->orWhereHas('receivingUser', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

            $trades->orWhereHas('sendingItem', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

            $trades->orWhereHas('receivingItem', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        }

        $trades->with('sendingUser', 'receivingUser', 'sendingItem', 'receivingItem');
        $trades = $trades->paginate($this->perPage);

        return view('livewire.trades-table', compact('trades'));
    }
}
