<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
    public $item;
    public $isLiked;
    public $likeCount;

    public function mount($item)
    {
        $this->item = $item;
        $this->isLiked = Like::where('user_id', Auth::id())->where('item_id', $this->item->id)->exists();
        $this->likeCount = Like::where('item_id', $this->item->id)->count();
    }

    public function toggleLike()
    {
        if ($this->isLiked) {
            Like::where('user_id', Auth::id())->where('item_id', $this->item->id)->delete();
            $this->isLiked = false;
            $this->likeCount--;
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'item_id' => $this->item->id,
            ]);
            $this->isLiked = true;
            $this->likeCount++;
        }
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
