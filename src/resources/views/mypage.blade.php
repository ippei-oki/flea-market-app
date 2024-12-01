@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="profile">
    <div class="profile__content">
        <img src="{{ asset($user->profile_image) }}" alt="プロフィール画像" class="profile__image">
        <p class="profile__name">{{ $user->name }}</p>
        <a href="{{ route('profile.edit') }}" class="btn-profile-edit">プロフィールを編集</a>
    </div>
    <div class="profile__tabs">
        <a href="{{ route('mypage.sell') }}" class="profile__tab {{ $tab === 'sell' ? 'active' : '' }}">出品した商品</a>
        <a href="{{ route('mypage.purchase') }}" class="profile__tab {{ $tab === 'purchase' ? 'active' : '' }}">購入した商品</a>
    </div>
    <div class="profile__items">
        @if($tab === 'sell' && isset($sellItems))
            @foreach ($sellItems as $item)
                <div class="item">
                    <img class="item-image" src="{{ asset('storage/item_images/' . $item->image) }}" alt="{{ $item->name }}">
                    <p class="item-name">{{ $item->name }}</p>
                </div>
            @endforeach
        @elseif($tab === 'purchase' && isset($purchasedItems))
            @foreach ($purchasedItems as $item)
                <div class="item">
                    <img class="item-image" src="{{ asset('storage/item_images/' . $item->image) }}" alt="{{ $item->name }}">
                    <p class="item-name">{{ $item->name }}</p>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection