<?php

use Illuminate\Support\Facades\Route;

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {
    }
}
$tasks = [
    new Task(
        1,
        'Buy groceries',
        'Task 1 description',
        'Task 1 long description',
        false,
        '2023-03-01 12:00:00',
        '2023-03-01 12:00:00'
    ),
    new Task(
        2,
        'Sell old stuff',
        'Task 2 description',
        null,
        false,
        '2023-03-02 12:00:00',
        '2023-03-02 12:00:00'
    ),
    new Task(
        3,
        'Learn programming',
        'Task 3 description',
        'Task 3 long description',
        true,
        '2023-03-03 12:00:00',
        '2023-03-03 12:00:00'
    ),
    new Task(
        4,
        'Take dogs for a walk',
        'Task 4 description',
        null,
        false,
        '2023-03-04 12:00:00',
        '2023-03-04 12:00:00'
    ),
];

Route::get('/', function () {
    return view('index', ['name'=> 'Ali']);
    // return view('welcome');
});

Route::get('/hello', function () {
    return 'hello' ;
})->name('hello');

// Redirect routing
Route::get('/hallo', function () {
    // redirect funciton returns an object so may direct access something inside
    // return redirect('/hello') ;
    return redirect()->route('hello') ;
});

Route::get('/greet/{name}', function ($name) {
    return 'hello ' . $name . '!';
});

// 虽然内建了404页面，但是这个可以依然带去这个地方
Route::fallback(action: function () {
    return 'Still got somewhere!' ;
});
