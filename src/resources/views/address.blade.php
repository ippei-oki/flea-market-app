@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
  <div class="address-page">
    <h2>住所の変更</h2>
    <form action="{{ route('purchase.address.update', ['item_id' => $item->id]) }}" method="post">
      @csrf

      <div class="form-group">
        <label for="postal_code">郵便番号</label>
        <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}">
        <div class="form__error">
            @error('postal_code') <span>{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="form-group">
        <label for="address">住所</label>
        <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}">
        <div class="form__error">
            @error('address') <span>{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="form-group">
        <label for="building">建物名</label>
        <input type="text" id="building" name="building" value="{{ old('building', $user->building) }}">
        <div class="form__error">
            @error('building') <span>{{ $message }}</span> @enderror
        </div>
      </div>

      <button type="submit" class="btn-primary">更新する</button>
    </form>
  </div>
@endsection