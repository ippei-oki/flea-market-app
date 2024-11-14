<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryTags extends Component
{
    public $categories;
    public $selectedCategories = [];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function toggleCategory($categoryId)
    {
        if (in_array($categoryId, $this->selectedCategories)) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$categoryId]);
        } else {
            $this->selectedCategories[] = $categoryId;
        }
    }

    public function render()
    {
        return view('livewire.category-tags');
    }
}
