<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
      $filter = request('filter', null);
      return view('index', compact('filter'));
    }

    public function detail($item_id)
    {
      $item = Item::with(['categories', 'condition', 'comments.user'])->findOrFail($item_id);
      return view('items.detail', compact('item'));
    }
}