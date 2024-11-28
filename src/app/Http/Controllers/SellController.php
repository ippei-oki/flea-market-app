<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Sell;

class SellController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::orderBy('id', 'desc')->get();
        return view('sell', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->explanation = $request->explanation;
        $item->price = $request->price;
        $item->condition_id = $request->condition;
        $item->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('item_images', 'public');
            $item->image = $path;
        }

        $item->save();

        if ($request->filled('selectedCategories')) {
            foreach ($request->selectedCategories as $categoryId) {
                $item->categories()->attach($categoryId);
            }
        }

        Sell::create([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
        ]);

        return redirect()->route('home')->with('success', '商品を出品しました');
    }
}