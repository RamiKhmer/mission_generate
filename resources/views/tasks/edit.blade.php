@extends('layout')

@section('content')
    <h1>Edit Task</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ref" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="mb-3">
            <label for="ref" class="form-label">Descripiton</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>
        <!-- New fields -->
        <div class="mb-3">
            <label for="ref" class="form-label">Ref</label>
            <input type="text" name="ref" id="ref" class="form-control" value="{{ old('ref', $task->ref) }}">
        </div>

        <div class="mb-3">
            <label for="by" class="form-label">By</label>
            <input type="text" name="by" id="by" class="form-control" value="{{ old('by', $task->by) }}">
        </div>

        <div class="mb-3">
            <label for="startdate" class="form-label">Start Date</label>
            <input type="date" name="startdate" id="startdate" class="form-control"
                value="{{ old('startdate', $task->startdate) }}">
        </div>

        <div class="mb-3">
            <label for="enddate" class="form-label">End Date</label>
            <input type="date" name="enddate" id="enddate" class="form-control"
                value="{{ old('enddate', $task->enddate) }}">
        </div>

        <div class="mb-3">
            <label for="datesign" class="form-label">Date Signed</label>
            <input type="date" name="datesign" id="datesign" class="form-control"
                value="{{ old('datesign', $task->datesign) }}">
        </div>

        <div class="mb-3">
            <label for="spp" class="form-label">SPP</label>
            <input type="text" name="spp" id="spp" class="form-control" value="{{ old('spp', $task->spp) }}">
        </div>

        <h5>Edit People</h5>
        <div id="people-wrapper">
            @foreach ($task->people as $index => $person)
                <div class="row mb-2 person-entry">
                    <input type="hidden" name="people[{{ $index }}][id]" value="{{ $person->id }}">
                    <div class="col">
                        <input type="text" name="people[{{ $index }}][title]" value="{{ $person->title }}"
                            class="form-control" placeholder="Title">
                    </div>
                    <div class="col">
                        <input type="text" name="people[{{ $index }}][name]" value="{{ $person->name }}"
                            class="form-control" placeholder="Name">
                    </div>
                    <div class="col">
                        <input type="text" name="people[{{ $index }}][gender]" value="{{ $person->gender }}"
                            class="form-control" placeholder="Gender">
                    </div>
                    <div class="col">
                        <input type="text" name="people[{{ $index }}][job]" value="{{ $person->job }}"
                            class="form-control" placeholder="Job">
                    </div>
                    <div class="col">
                        <input type="text" name="people[{{ $index }}][level]" value="{{ $person->level }}"
                            class="form-control" placeholder="Level">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger btn-sm" onclick="removePerson(this)">Remove</button>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary mb-3" onclick="addPersonFields()">+ Add Person</button>



        <button type="submit" class="form-control btn btn-primary">Update</button>
    </form>

    <br>
    <br>
    <br>
    <script>
        let personIndex = {{ $task->people->count() }};

        function addPersonFields() {
            const wrapper = document.getElementById('people-wrapper');
            const row = document.createElement('div');
            row.classList.add('row', 'mb-2', 'person-entry');
            row.innerHTML = `
                <div class="col">
                    <input type="text" name="people[${personIndex}][title]" class="form-control" placeholder="Title">
                </div>
                <div class="col">
                    <input type="text" name="people[${personIndex}][name]" class="form-control" placeholder="Name">
                </div>
                <div class="col">
                    <input type="text" name="people[${personIndex}][gender]" class="form-control" placeholder="Name">
                </div>
                <div class="col">
                    <input type="text" name="people[${personIndex}][job]" class="form-control" placeholder="Job">
                </div>
                <div class="col">
                    <input type="text" name="people[${personIndex}][level]" class="form-control" placeholder="Level">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removePerson(this)">Remove</button>
                </div>
            `;
            wrapper.appendChild(row);
            personIndex++;
        }

        function removePerson(button) {
            const row = button.closest('.person-entry');
            row.remove();
        }
    </script>

@endsection
