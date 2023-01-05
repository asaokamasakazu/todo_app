@extends('layouts.application')

@section('title')
{{ $task->task_name }}の編集
@endsection

@section('content')
<div class="main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">タスク「{{ $task->task_name }}」の編集</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.update', $task) }}">
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <label for="task_name" class="col-md-4 col-form-label text-md-end">タスク名</label>
                                <div class="col-md-6">
                                    <input id="task_name" type="text" class="form-control @error('task_name') is-invalid @enderror" name="task_name" value="{{ old('task_name') ?? $task->task_name }}" required autofocus>
                                    @error('task_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">タスク説明</label>
                                <div class="col-md-6">
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="7" required>{{ old('description') ?? $task->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">ステータス</label>
                                <div class="col-md-6">
                                    <select name="status" id="status"  class="form-select @error('status') is-invalid @enderror" required>
                                        @if (old('status') != null)
                                            <option value="未着手" @if(old('status') == '未着手') selected @endif>未着手</option>
                                            <option value="着手中" @if(old('status') == '着手中') selected @endif>着手中</option>
                                            <option value="完了" @if(old('status') == '完了') selected @endif>完了</option>
                                        @else
                                            <option value="未着手" @if($task->status == '未着手') selected @endif>未着手</option>
                                            <option value="着手中" @if($task->status == '着手中') selected @endif>着手中</option>
                                            <option value="完了" @if($task->status == '完了') selected @endif>完了</option>
                                        @endif
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="deadline" class="col-md-4 col-form-label text-md-end">期限</label>
                                <div class="col-md-6">
                                    <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') ?? $task->deadline->format('Y-m-d') }}" min="{{ $today }}" required>
                                    @error('deadline')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">更新する</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
