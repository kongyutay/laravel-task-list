<?php

// use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    // 这是静态方法，会返回整个实列或集合
    // return view('index', [
    //     'tasks' => \App\Models\Task::all()
    // ]);

    // 一般上静态方法通常直接返回模型实例或集合（例如 find, all, create）。
    // 查询构建器方法：需要通过方法链继续构建查询（例如 where, orderBy, latest）

    // 这个Eloquent ORM内建Query Builder，所以可以不用自己写query，query builder建立完成后要call get method才会执行，会返回构建器实例
    return view('index', [
        'tasks' => \App\Models\Task::latest()->get()
    ]);
    // return view('index', [
    //     'tasks' => \App\Models\Task::latest()->where('completed', true)->get()
    // ]);
})->name('tasks.index');

Route::get('/tasks/{id}', function ($id) {
    // return view('show', ['task' => \App\Models\Task::find('id', $id)]);
    return view('show', ['task' => \App\Models\Task::findOrFail('id', $id)]);
})->name('tasks.show');

// Route::get('/hello', function () {
//     return 'hello' ;
// })->name('hello');

// Redirect routing
// Route::get('/hallo', function () {
//     // redirect funciton returns an object so may direct access something inside
//     // return redirect('/hello') ;
//     return redirect()->route('hello') ;
// });

// Route::get('/greet/{name}', function ($name) {
//     return 'hello ' . $name . '!';
// });

// 虽然内建了404页面，但是这个可以依然带去这个地方
Route::fallback(action: function () {
    return 'Customize 404 Still got somewhere!' ;
});
