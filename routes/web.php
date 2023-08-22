<?php
use App\Models\Task;
use App\Http\Requests\TaskRequest;
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


Route::get('/tasks/{task}', function (Task $task) {
  return view('show',[
    // 'task' => Task::findOrFail($id),
    'task' => $task,
  ]);
})->name('tasks.show');


Route::get('/tasks/{task}/edit', function (Task $task) {
  return view('edit',[
    // 'task' => Task::findOrFail($id),
    'task' => $task,
  ]);
})->name('tasks.edit');

Route::post('/tasks', function (TaskRequest $request){
  // a better way to store data than above codes
  // the $request->validated() is a laravel function from $request object which validate input based on rules we set in TaskRequest.php located at app\http\request\
  $task = Task::create($request->validated());
  return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task created successfully');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request){
  // dd($task);
  // $task is model then get the task id from the url, therefore model update the data with the selected id
  $task->update($request->validated());
  return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task updated successfully');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task){
  $task->delete();
  return redirect()->route('tasks.index')->with('success', 'Task Deleted Successfully');
})->name('tasks.destroy');



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
