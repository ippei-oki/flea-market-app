<div>
    <form method="POST" action="{{ route('purchase.stripe.session') }}">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <button type="submit" class="btn btn-primary">
            購入する
        </button>
    </form>
</div>
