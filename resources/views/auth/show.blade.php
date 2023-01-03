@extends('layouts.application')

@section('title')
{{ $user->name }}のマイページ
@endsection

@section('content')
<div class="main">
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $user->name }}のマイページ</div>
                    <div class="card-body">
                        <a href="{{ route('user.edit', $user) }}" class="btn btn-primary mb-3">編集する</a>
                        <p>ユーザー名: {{ $user->name }}</p>
                        <p>メールアドレス: {{ $user->email }}</p>
                        <p>パスワード: *****</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
