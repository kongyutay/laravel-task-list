@extends('layouts.app')

{{-- section 的第二个参数接收一个默认值，如果里面没有提供内容，就会使用默认值，以下就是例子 --}}
@section('title', 'The list of task')

@section('content')
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['id' => $task->id]) }}">
                {{ $task->title }}
            </a>
        </div>

    @empty
        <div>There are no tasks!</div>
    @endforelse
@endsection
