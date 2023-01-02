<header>
    <div class="header-container">
        <a class="header-home-a" href="/">
            <i class="fa-solid fa-house"></i>
        </a>
        @auth
            <a href="#">タスク登録</a>
            <a href="{{ route('user.show', ['id'=>auth()->id()]) }}">マイページ</a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <a href="{{ route('register') }}">新規登録</a>
            <a href="{{ route('login') }}">ログイン</a>
        @endauth
    </div>
</header>
<div class="under-header"></div>
