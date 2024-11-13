@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
  <div class="item-detail">
    <div class="item-image">
      <img src="{{ asset('storage/item_images/' . $item->image) }}" alt="{{ $item->name }}">
    </div>
    <div class="item-info">
      <h1>{{ $item->name }}</h1>
      <p>{{ $item->brand }}</p>
      <h2>￥{{ $item->price }}(税込)</h2>
      <div class="item-info__icon">
        @livewire('like-button', ['item' => $item])
        @livewire('comment-count', ['item' => $item])
      </div>
      <div class="btn-area">
        <a href="{{ route('purchase.details', ['item_id' => $item->id]) }}" class="btn-success" style="margin-top: 15px;">
          購入手続きへ
        </a>
      </div>
      <h2>商品説明</h2>
      <p>{{ $item->explanation }}</p>
      <h2>商品の情報</h2>
      <p>カテゴリー
        @foreach ($item->categories as $category)
          <span class="category-tag">{{ $category->name }}</span>
        @endforeach
      </p>
      <p>商品の状態 {{ $item->condition->condition }}</p>
      <h2>コメント({{ $item->comments->count() }})</h2>

      @foreach ($item->comments as $comment)
        <div class="comment">
          <div class="user-info">
            <img src="{{ asset('storage/profile_images/' . $comment->user->profile_image) }}" alt="{{ $comment->user->name }}" class="user-image">
            <p><strong>{{ $comment->user->name }}</strong></p>
          </div>
          <p>{{ $comment->comment }}</p>
        </div>
      @endforeach

      @if(auth()->check())
        <h3>商品へのコメント</h3>
        <form action="{{ route('comment.store', ['item_id' => $item->id]) }}" method="POST">
          @csrf
          <textarea class="comment-area" name="comment"></textarea>
          @error('comment')
            <div class="error">{{ $message }}</div>
          @enderror
          <button class="btn-send" type="submit">コメントを送信する</button>
        </form>
      @else
        <p>コメントを送信するにはログインが必要です。</p>
      @endif
    </div>
  </div>
@endsection