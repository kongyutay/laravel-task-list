@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
    <form action="POST" action="{{ route('tasks.store') }}">
        {{-- 有了这个csrf，laravel会通过middleware自动验证token是否存在于表单之中 --}}
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" />
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5"></textarea>
        </div>

        <div>
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10"></textarea>
        </div>

        <div>
            <button type="submit">Add Task</button>
        </div>
    </form>
@endsection
