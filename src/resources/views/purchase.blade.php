@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <div class="purchase-page">
    <div class="confirmation-area">
      <div class="item-info">
        <img class="item-image" src="{{ asset('storage/item_images/' . $item->image) }}" alt="{{ $item->name }}">
        <div class= "item-cont">
          <h2>{{ $item->name }}</h2>
          <h2>￥{{ number_format($item->price) }}</h2>
        </div>
      </div>
      <div>
        @livewire('purchase-component', ['item' => $item])
      </div>
      <div class="delivery-address">
        <div class="delivery-address__title">
          <h2>配送先</h2>
          <a href="{{ route('purchase.address', ['item_id' => $item->id]) }}" class="change-address-btn">変更する</a>
        </div>
        <p>〒{{ $user->postal_code }}</p>
        <p>{{ $user->address }}{{ $user->building }}</p>
        @error('delivery_address')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="settlement-area">
      <div>
        @livewire('subtotal', ['item' => $item])
      </div>
      <div>
        @livewire('purchase-stripe-button', ['item' => $item])
      </div>
    </div>
  </div>
@endsection