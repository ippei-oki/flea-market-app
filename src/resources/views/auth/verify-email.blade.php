@extends('layouts.app')

@section('content')
<div class="verify-email">
    <h1>メールアドレスの確認</h1>
    <p>登録したメールアドレスに確認リンクを送信しました。リンクをクリックしてメールアドレスを確認してください。</p>
    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <button type="submit">再送信</button>
    </form>
</div>
@endsection
