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
        $this->items = Item::with('purchase')->get()->map(function ($item) {
            $item->is_sold = $item->purchase()->exists();
            return $item;
        });
    }

    public function updateResults($search)
    {
        if (empty($search)) {
            $this->items = Item::with('purchase')->get()->map(function ($item) {
                $item->is_sold = $item->purchase()->exists();
                return $item;
            });
        } else {
            $this->items = Item::with('purchase')
                ->where('name', 'like', '%' . $search . '%')
                ->get()
                ->map(function ($item) {
                    $item->is_sold = $item->purchase()->exists();
                    return $item;
                });
        }
    }

    public function render()
    {
        return view('livewire.search-results');
    }
}
