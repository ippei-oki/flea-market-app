<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SearchResults extends Component
{
    public $items = [];
    public $filter;

    protected $queryString = ['filter'];

    protected $listeners = ['searchUpdated' => 'updateResults'];

    public function mount()
    {
        $this->filter = $this->filter ?? 'recommend';
        $this->loadItems();
    }

    public function updateResults($search)
    {
        $this->loadItems($search);
    }

    private function loadItems($search = null)
    {
        $query = $this->buildQuery($search);
        if ($query) {
            $this->items = $query->get()->map(function ($item) {
                $item->is_sold = $item->purchase !== null;
                return $item;
            });
        } else {
            $this->items = [];
        }
    }

    private function buildQuery($search = null)
    {
        $query = Item::query()->with('purchase');
        switch ($this->filter) {
            case 'recommend':
                $query = $this->applyRecommendFilter($query);
                break;
            case 'mylist':
                $query = $this->applyMylistFilter($query);
                break;
            default:
                $query = $this->applyDefaultFilter($query);
                break;
        }
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }

    private function applyRecommendFilter($query)
    {
        return $query->where(function ($q) {
            if (Auth::check()) {
                $q->where('user_id', '!=', Auth::id());
            } else {
                $q->whereNull('user_id');
            }
        });
    }

    private function applyMylistFilter($query)
    {
        if (Auth::check()) {
            $likedItems = Auth::user()->likes->pluck('item_id');
            if ($likedItems->isEmpty()) {
                return $query->whereRaw('0 = 1');
            }
            return $query->whereIn('id', $likedItems);
        }
        return $query->whereRaw('0 = 1');
    }

    private function applyDefaultFilter($query)
    {
        return $this->applyRecommendFilter($query);
    }

    public function render()
    {
        return view('livewire.search-results', ['items' => $this->items]);
    }
}