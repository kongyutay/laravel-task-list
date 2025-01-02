@extends('layouts.app')

{{-- section 的第二个参数接收一个默认值，如果里面没有提供内容，就会使用默认值，以下就是例子 --}}
@section('title', $task->title)

@section('content')
    <p>{{ $task->description }}</p>

    @if ($task->long_description)
        <p>{{ $task->long_description }}</p>
    @endif

    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>

    <p>
        @if ($task->completed)
            Completed
        @else
            Not Completed
        @endif
    </p>

    {{-- 不传入id也可以，laravel自动知道要拿primary key --}}
    <div>
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">Edit</a>
    </div>

    <div>
        <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
            @csrf
            @method('PUT')
            <button type="submit">
                Mark as {{ $task->completed ? 'not completed' : 'completed' }}
            </button>
        </form>
    </div>

    <div>
        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection
