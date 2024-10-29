@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="profile-setup">
    <h2 class="title">プロフィール設定</h2>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group__img">

            <div class="profile-image-container" id="profileImagePreview"
                 style="background-image: url('{{ old('profile_image', auth()->user()->profile_image_url ?? '') }}');">
            </div>

            <input type="file" name="profile_image" id="profileImageInput" class="hidden">
            <label for="profileImageInput" class="custom-file-label">画像を選択する</label>

            <div class="form__error">
                @error('profile_image') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="name">ユーザー名</label><br>
            <input class="form-group__input" type="text" name="name" value="{{ old('name', auth()->user()->name) }}">
            <div class="form__error">
                @error('name') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="postal_code">郵便番号</label><br>
            <input class="form-group__input" type="text" name="postal_code" value="{{ old('postal_code', auth()->user()->postal_code) }}">
            <div class="form__error">
                @error('postal_code') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="address">住所</label><br>
            <input class="form-group__input" type="text" name="address" value="{{ old('address', auth()->user()->address) }}">
            <div class="form__error">
                @error('address') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="building">建物名</label><br>
            <input class="form-group__input" type="text" name="building" value="{{ old('building', auth()->user()->building) }}">
            <div class="form__error">
                @error('building') <span>{{ $message }}</span> @enderror
            </div>
        </div>

        <button class="form__button-update" type="submit">更新する</button>
    </form>
</div>
@endsection