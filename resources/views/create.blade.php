@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
    {{-- 如果有返回错误，会是error对象，具体可以读取errors对象内的属性 --}}
    {{-- {{ $errors }} --}}
    <form action="POST" action="{{ route('tasks.store') }}">
        {{-- 有了这个csrf，laravel会通过middleware自动验证token是否存在于表单之中 --}}
        {{-- session会放在storage/framework/sessions里面的一个文件，这是默认设置，如果规模变大，无法share这些session去其他server，所以可以在session.php文件那里调整设置参数，把driver中的file调成redis或者memcached，这才是最好的方案 --}}
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" />
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5"></textarea>
            @error('description')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10"></textarea>
            @error('long_description')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit">Add Task</button>
        </div>
    </form>
@endsection
