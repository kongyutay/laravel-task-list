@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('content')
    {{-- 如果有返回错误，会是error对象，具体可以读取errors对象内的属性 --}}
    {{-- {{ $errors }} --}}
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        {{-- 有了这个csrf，laravel会通过middleware自动验证token是否存在于表单之中 --}}
        {{-- session会放在storage/framework/sessions里面的一个文件，这是默认设置，如果规模变大，无法share这些session去其他server，所以可以在session.php文件那里调整设置参数，把driver中的file调成redis或者memcached，这才是最好的方案 --}}
        @csrf
        @isset($task)
            @method('PUT')
        @endisset

        {{-- 在提交表单的时候后端会进行验证，但是也会清空input，如果验证失败，需要用户重新填写整个表单，非常不友好，使用old方法可以自动填充 --}}
        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" @class(['border-red-500' => $errors->has('title')])
                value="{{ $task->title ?? old('title') }}" />
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" @class(['border-red-500' => $errors->has('title')])>{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10" @class(['border-red-500' => $errors->has('title')])>{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2 items-center">
            <button type="submit" class="btn">
                @isset($task)
                    Update Task
                @else
                    Add Task
                @endisset
            </button>
            <a href="{{ route('tasks.index') }}" class="link">Cancel</a>
        </div>
    </form>
@endsection
