@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Create Task</a>
    </div>

    <ul class="list-group">
        @foreach ($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $task->title }}</strong><br>
                    <small>{{ $task->description }}</small>
                </div>
                <div class="btn-group">
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    <button onclick="window.open('{{ route('tasks.print', $task->id) }}', '_blank')" class="btn btn-primary">Print Task</button>
                </div>

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

            </li>
        @endforeach
    </ul>

    <div class="mt-3">
        {{ $tasks->links('pagination::bootstrap-4') }}
    </div>
@endsection
