<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class SearchResults extends Component
{
    public $items = [];

    protected $listeners = ['searchUpdated' => 'updateResults'];

    public function mount()
    {
        $this->items = Item::all();
    }

    public function updateResults($search)
    {
        if (empty($search)) {
            $this->items = Item::all();
        } else {
            $this->items = Item::where('name', 'like', '%' . $search . '%')->get();
        }
    }

    public function render()
    {
        return view('livewire.search-results');
    }
}
