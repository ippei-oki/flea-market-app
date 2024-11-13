<div class="payment-method">
  <label class="payment-method__label" for="payment_method">支払い方法</label><br>
  <select class="payment-method__select" id="payment_method" wire:model="payment_method">
    <option value="">選択してください</option>
    <option value="convenience_store">コンビニ払い</option>
    <option value="card">カード支払い</option>
  </select>
  @error('payment_method') <span class="alert alert-danger">{{ $message }}</span> @enderror
</div>