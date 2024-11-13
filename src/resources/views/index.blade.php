@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
  <div class="display-items">
    <p class="list-select">おすすめ</p>
    <p class="list-select">マイリスト</p>
  </div>

  <livewire:search-results />
@endsection