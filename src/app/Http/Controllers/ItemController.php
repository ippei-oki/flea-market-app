<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
      $items = Item::all();
      return view('index', compact('items'));
    }

    public function detail($item_id)
    {
      $item = Item::with(['categories', 'condition', 'comments.user'])->findOrFail($item_id);

      return view('items.detail', compact('item'));
    }
}