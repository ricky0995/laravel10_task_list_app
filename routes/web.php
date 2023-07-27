<?php
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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


Route::get('/', function(){
    return redirect()->route('tasks.index');
});

// To Use a Variable with anonymous function, need to type 'use' keyword
Route::get('/tasks', function () use ($tasks) {
    return view('index', [
        'tasks' => $tasks
        
        // the value will be escaped by laravel, so html/script tag will be displayed as string
        // 
        // 'name' => 'Ricky',
    ]);
    // return view('welcome');
})->name('tasks.index');

Route::get('/tasks/{id}', function ($id) use ($tasks) {

    // colect function is from laravel, it is a collection object with some function
    $task = collect($tasks)->firstWhere('id', $id);
    if(!$task) {
        abort(Response::HTTP_NOT_FOUND);
    }
    return view('show', ['task' => $task]);
    // return 'One single task';
})->name('tasks.show');


// // example of named route
// Route::get('/hello', function(){
//     return 'Hello';
// })->name('hello');

// // example tp redirect a route to another route
// Route::get('/hallo', function(){
//     // redirect with normal route url
//     // return redirect('/hello');

//     // redirect with named route
//     return redirect()->route('hello');
// });

// // dynamic url : example of route(url) with parameter
// Route::get('/greet/{name}', function ($name){
//     return 'Hello ' . $name . '!';
// });

// this is route is triggered when requested url not found
Route::fallback(function(){
    return 'still got somewhere!';
});
