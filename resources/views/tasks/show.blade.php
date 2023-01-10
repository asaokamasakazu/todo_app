@extends('layouts.application')

@section('title')
{{ $task->task_name }}の詳細
@endsection

@section('content')
<div class="main">
    <div class="main-container">
        @include('components.flash')
        <h1>タスク「{{ $task->task_name }}」の詳細</h1>
        <div class="show-btns mt-4 mb-3">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">編集する</a>
            <form class="show-delete-form btn btn-danger" action="{{ route('tasks.destroy', $task) }}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="削除する" onclick='return confirm("タスクを削除しますか？");'>
            </form>
        </div>
        <table class="show-table">
            <tr>
                <th>タスク名</th>
                <td>{{ $task->task_name }}</td>
            </tr>
            <tr>
                <th>タスク説明</th>
                <td>{{ $task->description }}</td>
            </tr>
            <tr>
                <th>ステータス</th>
                <td>{{ $task->status }}</td>
            </tr>
            <tr>
                <th>期限</th>
                <td>{{ $task->deadline->format('Y / m / d (D)') }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
