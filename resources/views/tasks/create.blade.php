@extends('layout')

@section('content')
    <h1>Create Task</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description"></textarea>

        <!-- New fields -->
        <div class="mb-3">
            <label for="ref" class="form-label">Ref</label>
            <input type="text" name="ref" id="ref" class="form-control">
        </div>

        <div class="mb-3">
            <label for="by" class="form-label">By</label>
            <input type="text" name="by" id="by" class="form-control">
        </div>

        <div class="mb-3">
            <label for="startdate" class="form-label">Start Date</label>
            <input type="date" name="startdate" id="startdate" class="form-control">
        </div>

        <div class="mb-3">
            <label for="enddate" class="form-label">End Date</label>
            <input type="date" name="enddate" id="enddate" class="form-control">
        </div>

        <div class="mb-3">
            <label for="datesign" class="form-label">Date Signed</label>
            <input type="date" name="datesign" id="datesign" class="form-control">
        </div>

        <div class="mb-3">
            <label for="spp" class="form-label">SPP</label>
            <input type="text" name="spp" id="spp" class="form-control">
        </div>

        <input type="hidden" name="people" value="[]">
        <h5>Assign People</h5>
        <div id="people-wrapper">
            <div class="row mb-2 person-entry">
                <div class="col">
                    <input type="text" name="people[0][title]" class="form-control" placeholder="Title">
                </div>
                <div class="col">
                    <input type="text" name="people[0][name]" class="form-control" placeholder="Name">
                </div>
                <div class="col">
                    <input type="text" name="people[0][gender]" class="form-control" placeholder="Gender">
                </div>
                <div class="col">
                    <input type="text" name="people[0][job]" class="form-control" placeholder="Job">
                </div>
                <div class="col">
                    <input type="text" name="people[0][level]" class="form-control" placeholder="Level">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removePerson(this)">Remove</button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mb-3" onclick="addPersonFields()">+ Add Person</button>

        <button type="submit">Save</button>
    </form>

    <script>
        let personIndex = 1;

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
