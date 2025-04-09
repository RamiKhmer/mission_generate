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
                    {{ $loop->iteration }}
                </div>
                <div>
                    <strong>{{ $task->title }}</strong><br>
                    <small>{{ $task->description }}</small>
                   <br>
                    <small class="siemreap-regular"> {{ $task->luna_date }}</small>
                    <br>
                    <small class="siemreap-regular">{{ $task->khmer_date }}</small>
                    <br>
                    <small class="siemreap-regular">{{ $task->datesign  }}</small>
                </div>
                <div class="btn-group-vertical" role="group" aria-label="Task Actions">
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-info mb-1">
                        <i class="bi bi-eye"></i> View
                    </a>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning mb-1">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mb-1">
                            <i class="bi bi-trash3-fill"></i> Delete
                        </button>
                    </form>
                    
                    <button onclick="window.open('{{ route('tasks.print', $task->id) }}', '_blank')" class="btn btn-primary">
                        <i class="bi bi-printer-fill"></i> Print Task
                    </button>
                </div>
                
                
                <ul>
                    @foreach ($task->people as $person)
                        <div class="card mb-2">
                            <div class="card-body">
                                <strong>{{ $person->title }} {{ $person->name }}</strong><br>
                                {{-- <span>Job: {{ $person->job }}</span><br> --}}
                                {{-- <span>Level: {{ $person->level }}</span> --}}
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
