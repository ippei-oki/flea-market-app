<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>coachtechフリマ</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
  @livewireStyles
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <img class="header__logo" src="{{asset('storage/logo.svg')}}">
        @if (!in_array(request()->path(), ['register', 'login']))
          <div class="header-nav__item">
            <livewire:search-input />
          </div>
          <nav>
            <ul class="header-nav">
              <li class="header-nav__item">
                <form action="/logout" method="post">
                  @csrf
                  <button class="header-nav__button">ログアウト</button>
                </form>
              </li>
              <li class="header-nav__item">
                <a class="header-nav__link" href="/mypage">マイページ</a>
              </li>
              <li class="header-nav__item">
                <a class="header-nav__link--sell" href="/sell">出品</a>
              </li>
            </ul>
          </nav>
        @endif
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
  @livewireScripts
</body>

</html>