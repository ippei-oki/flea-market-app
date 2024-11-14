@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="profile">
    <div class="profile__content">
        <img src="{{ asset('storage/profile_images/' . $user->profile_image) }}" alt="プロフィール画像" class="profile__image">
        <p class="profile__name">{{ $user->name }}</p>
    </div>
</div>
@endsection