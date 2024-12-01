@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
  <div>
    <a href="{{ url('items?filter=recommend') }}" 
       class="{{ request('filter') === 'recommend' ? 'active-tab' : 'inactive-tab' }}">
        おすすめ
    </a>

    <a href="{{ url('items?filter=mylist') }}" 
       class="{{ request('filter') === 'mylist' ? 'active-tab' : 'inactive-tab' }}">
        マイリスト
    </a>
  </div>
  <livewire:search-results :filter="request()->get('filter', 'recommend')" />
@endsection