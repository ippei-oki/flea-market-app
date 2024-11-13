<div>
    <div class="payment-method">
        <label class="payment-method__label" for="paymentMethod">支払い方法</label><br>
        <select class="payment-method__select" id="paymentMethod" wire:model="payment_method">
            <option value="">選択してください</option>
            <option value="convenience_store">コンビニ払い</option>
            <option value="card">カード支払い</option>
        </select>
        @error('payment_method')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>