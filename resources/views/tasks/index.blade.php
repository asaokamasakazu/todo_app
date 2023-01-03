@extends('layouts.application')

@section('title', 'トップページ')

@section('content')
<div class="main">
    <div class="main-container">
        @auth
            <h1>{{ auth()->user()->name }}さん、ToDoアプリへようこそ</h1>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary mt-4 mb-3">タスクを登録する</a>
            <table class="top-table">
                <thead>
                    <tr>
                        <th>タスク名</th>
                        <th>ステータス</th>
                        <th>期限</th>
                        <th colspan="3">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->task_name }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->deadline }}</td>
                            <td><a href="{{ route('tasks.show', $task) }}">詳細</a></td>
                            <td><a href="{{ route('tasks.edit', $task) }}">編集</a></td>
                            <td>
                                <form class="table-delete-form" action="{{ route('tasks.destroy', $task) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="削除" onclick='return confirm("タスクを削除しますか？");'>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h1>ToDoアプリへようこそ</h1>
            <p class="top-message">
                ToDoアプリをご利用いただくには、<a href="{{ route('register') }}">新規登録</a>か<a href="{{ route('login') }}">ログイン</a>が必要です。
            </p>
        @endauth
    </div>
</div>
@endsection
