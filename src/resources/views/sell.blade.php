@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell-info">
    <h1 class="title">商品の出品</h1>

    <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="item-image">
            <p class="item-image__char">商品画像</p>
            <div class="item-image__area">
                <label for="image" class="custom-file-label">画像を選択する</label>
                <input type="file" name="image" id="image" class="hidden">
            </div>
            <div class="form__error">
                @error('image') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="sub-title-1">
            <p class="sub-title-1__char">商品の詳細</p>
        </div>

        <livewire:category-tags />

        <div class="item-condition">
            <p class="char-bold">商品の状態</p>
            <select class="select-condition" name="condition">
                <option value="" disabled selected>選択してください</option>
                @foreach($conditions as $condition)
                <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                @endforeach
            </select>
            <div class="form__error">
                @error('condition') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="sub-title-1">
            <p class="sub-title-1__char">商品名と説明</p>
        </div>

        <div class="item-name">
            <p class="char-bold">商品名</p>
            <input class="item-name__input" type="text" name="name">
            <div class="form__error">
                @error('name') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="item-description">
            <p class="char-bold">商品説明</p>
            <textarea class="item-description__input" name="explanation"></textarea>
            <div class="form__error">
                @error('explanation') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="item-price">
            <p class="char-bold">販売価格</p>
            <input class="item-price__input" type="number" name="price">
            <div class="form__error">
                @error('price') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <button class="btn-exhibit" type="submit">出品する</button>
    </form>
</div>
@endsection