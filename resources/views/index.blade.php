@extends('layouts.app')

@section('title', 'The List of Tasks')

@section('content')
  @forelse ($tasks as $task)
    <div>
      <a href="{{ route('tasks.show', ['id' => $task->id]) }}">{{ $task->title }}</a>
    </div>
    {{-- <div>{{ $task->title }}</div> --}}
  @empty
    <div>There are no tasks!</div>
  @endforelse
@endsection


{{-- <div>
  @if(count($tasks))
    @foreach($tasks as $task)
      <div>{{ $task->title }}</div>
    @endforeach
  @else
    <div>There are no tasks!</div>
  @endif
</div> --}}
