<?php
use App\Models\Task;
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

Route::get('/', function(){
    return redirect()->route('tasks.index');
});

// To Use a Variable with anonymous function, need to type 'use' keyword
Route::get('/tasks', function () {
  return view('index', [
    'tasks' => Task::latest()->get(),
  ]);
})->name('tasks.index');


Route::view('/tasks/create', 'create');


Route::get('/tasks/{id}', function ($id) {
  return view('show',[
    'task' => Task::findOrFail($id),
  ]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request){
  // dd($request->all());
  $data = $request->validate([
    'title'             => 'required|max:255',
    'description'       => 'required',
    'long_description'  => 'required',
  ]);
  $task = new Task;
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];

  $task->save();
  return redirect()->route('tasks.show', ['id' => $task->id]);
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
