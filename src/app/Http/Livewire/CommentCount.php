<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CommentCount extends Component
{
    public $item;
    public $commentCount;

    public function mount($item)
    {
        $this->item = $item;
        $this->commentCount = Comment::where('item_id', $this->item->id)->count();
    }

    public function render()
    {
        return view('livewire.comment-count');
    }
}