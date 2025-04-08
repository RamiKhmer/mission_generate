<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $people = \App\Models\Person::all();
        return view('tasks.create', compact('people'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ref' => 'nullable|string|max:255',
            'by' => 'nullable|string|max:255',
            'startdate' => 'nullable|date',
            'enddate' => 'nullable|date',
            'datesign' => 'nullable|date',
            'spp' => 'nullable|string|max:255',
            'people' => 'nullable|array',
            'people.*.name' => 'required|string|max:255',
            'people.*.gender' => 'required|string|max:255',
            'people.*.title' => 'nullable|string|max:255',
            'people.*.job' => 'nullable|string|max:255',
            'people.*.level' => 'nullable|string|max:255',
        ]);

        // Create the task
        $task = Task::create($request->only(['title', 'description', 'ref', 'by', 'startdate', 'enddate', 'datesign', 'spp']));

        // Check if people array exists and is not empty
        if (isset($request->people) && !empty($request->people)) {
            foreach ($request->people as $personData) {
                // Only create people if their name exists
                if (!empty($personData['name'])) {
                    $task->people()->create($personData);
                }
            }
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }



    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $task->load('people');
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ref' => 'nullable|string|max:255',
            'by' => 'nullable|string|max:255',
            'startdate' => 'nullable|date',
            'enddate' => 'nullable|date',
            'datesign' => 'nullable|date',
            'spp' => 'nullable|string|max:255',
            'people' => 'nullable|array', // Ensure people is nullable and can be an empty array
            'people.*.name' => 'required|string|max:255',
            'people.*.gender' => 'required|string|max:255',
            'people.*.title' => 'nullable|string|max:255',
            'people.*.job' => 'nullable|string|max:255',
            'people.*.level' => 'nullable|string|max:255',
        ]);

        // Update the task title and description
        $task->update($request->only(['title', 'description', 'ref', 'by', 'startdate', 'enddate', 'datesign', 'spp']));

        // Check if people array exists and is not empty
        if (isset($request->people) && !empty($request->people)) {
            $existingPeopleIds = $task->people()->pluck('id')->toArray();
            $submittedIds = [];

            // Loop through people and either update or create them
            foreach ($request->people as $personData) {
                if (!empty($personData['id'])) {
                    // Update existing person
                    $person = \App\Models\Person::find($personData['id']);
                    if ($person) {
                        $person->update($personData);
                        $submittedIds[] = $person->id;
                    }
                } else {
                    // Create new person
                    $task->people()->create($personData);
                }
            }

            // Delete people that are no longer part of the task
            $toDelete = array_diff($existingPeopleIds, $submittedIds);
            \App\Models\Person::destroy($toDelete);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated with assigned people.');
    }



    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }

    public function print(Task $task)
    {
        // Load related people for the task
        $task->load('people');

        // Return the print view
        return view('tasks.print', compact('task'));
    }
}
