<?php

// use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Requests\TaskRequest;


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
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
    // return view('show', ['task' => \App\Models\Task::find('id', $id)]);
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::post('/tasks', function(TaskRequest $request) {
    // dd($request->all());
    // $data = $request->validated();
    // $task = new Task();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    // 可以直接使用create方法执行，但是这属于mass assignment，默认受保护，要去Task.php那里重写
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success','Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function(Task $task, TaskRequest $request) {
    // dd($request->all());

    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    // 可以直接用update方法执行
    $task->update($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])->with('success','Task updated successfully!');
})->name('tasks.update');


// with() 方法用于向视图或重定向响应中附加数据。它是一种方便的方式来将额外的数据传递给视图或下一个请求的会话数据。
// 有分为视图的with和重定向的with
// 视图的with属于同一个请求
// 重定向的with保存在session里面作为flashmessage，为下一次请求使用
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

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
