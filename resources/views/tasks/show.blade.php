@extends('layout')

@section('content')
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>
    <a href="{{ route('tasks.index') }}">Back</a>


   
    <ul>
        @foreach ($task->people as $person)
            <div class="card mb-2">
                <div class="card-body">
                    <strong>{{ $person->title }} {{ $person->name }}</strong><br>
                    <span>Job: {{ $person->job }}</span><br>
                    <span>Level: {{ $person->level }}</span>
                </div>
            </div>
        @endforeach

    </ul>
@endsection
