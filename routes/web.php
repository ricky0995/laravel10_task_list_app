<?php
use Illuminate\Http\Response;
use Illuminate\Http\Request;
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

Route::get('/', function(){
    return redirect()->route('tasks.index');
});

// To Use a Variable with anonymous function, need to type 'use' keyword
Route::get('/tasks', function () {
  return view('index', [
    'tasks' => \App\Models\Task::latest()->get(),
  ]);
})->name('tasks.index');


Route::view('/tasks/create', 'create');


Route::get('/tasks/{id}', function ($id) {
  return view('show',[
    'task' => \App\Models\Task::findOrFail($id),
  ]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request){
  dd($request->all());
})->name('tasks.store');



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
