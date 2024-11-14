<div class="search-results">
    @foreach($items as $item)
        <div class="item-card">
            <a class="item-card__link" href="{{ route('item.detail', ['item_id' => $item->id]) }}">
                <img src="{{ asset('storage/item_images/' . $item->image) }}" alt="{{ $item->name }}" class="item-image">
                <p class="item-name">{{ $item->name }}</p>
                @if($item->is_sold)
                    <p class="status">SOLD</p>
                @endif
            </a>
        </div>
    @endforeach
</div>