@extends('layouts.app')

{{-- section 的第二个参数接收一个默认值，如果里面没有提供内容，就会使用默认值，以下就是例子 --}}
@section('title', 'The list of task')

@section('content')
    <nav class="mb-4">
        <a class="link" href="{{ route('tasks.create') }}">Add Task</a>
    </nav>

    @forelse ($tasks as $task)
        <div>
            <a @class(['line-through' => $task->completed]) href="{{ route('tasks.show', ['task' => $task->id]) }}">
                {{ $task->title }}
            </a>
        </div>

    @empty
        <div>There are no tasks!</div>
    @endforelse

    @if ($tasks->count())
        <nav class="">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection
