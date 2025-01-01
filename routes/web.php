<?php

// use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;


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
        'tasks' => Task::latest()->get()
    ]);
    // return view('index', [
    //     'tasks' => \App\Models\Task::latest()->where('completed', true)->get()
    // ]);
})->name('tasks.index');

// 要写在上面，先进行判断，不然会误以为id
Route::view('/tasks/create', 'create')->name('tasks.create');

// 可以对route进行依赖注入（注入模型）对route进行模型绑定，不需要自己fetch模型
// Route::get('/tasks/{id}/edit', function ($id) {
//     return view('edit', ['task' => Task::findOrFail('id', $id)]);
// })->name('tasks.edit');

// 默认task是primary key
Route::get('/tasks/{task}/edit', function ($task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function ($task) {
    // return view('show', ['task' => \App\Models\Task::find('id', $id)]);
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::post('/tasks', function(Request $request) {
    // dd($request->all());
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);
    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();
    return redirect()->route('tasks.show', ['id' => $task->id])->with('success','Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function(Task $task, Request $request) {
    // dd($request->all());
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();
    return redirect()->route('tasks.show', ['id' => $task->id])->with('success','Task updated successfully!');
})->name('tasks.update');

// Route::view('/tasks/create', 'create');

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
