@extends('layouts.app')

@section('title', 'Add Task')

@section('styles')
    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')
    {{-- 如果有返回错误，会是error对象，具体可以读取errors对象内的属性 --}}
    {{-- {{ $errors }} --}}
    <form action="POST" action="{{ route('tasks.store') }}">
        {{-- 有了这个csrf，laravel会通过middleware自动验证token是否存在于表单之中 --}}
        {{-- session会放在storage/framework/sessions里面的一个文件，这是默认设置，如果规模变大，无法share这些session去其他server，所以可以在session.php文件那里调整设置参数，把driver中的file调成redis或者memcached，这才是最好的方案 --}}
        @csrf

        {{-- 在提交表单的时候后端会进行验证，但是也会清空input，如果验证失败，需要用户重新填写整个表单，非常不友好，使用old方法可以自动填充 --}}
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" />
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5">{{ old('title') }}</textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10">{{ old('title') }}</textarea>
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit">Add Task</button>
        </div>
    </form>
@endsection
