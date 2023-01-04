<header>
    <div class="header-container">
        <a class="header-home-a" href="/">
            <i class="fa-solid fa-house"></i>
        </a>
        @auth
            <a href="{{ route('tasks.create') }}">タスク登録</a>
            <a href="{{ route('user.show', ['id'=>auth()->id()]) }}">マイページ</a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <form class="header-delete-form" action="{{route('user.destroy', ['id'=>auth()->id()])}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="退会" onclick='return confirm("アカウントを削除しますか？");'>
            </form>
        @else
            <a href="{{ route('register') }}">新規登録</a>
            <a href="{{ route('login') }}">ログイン</a>
        @endauth
    </div>
</header>
<div class="under-header"></div>
