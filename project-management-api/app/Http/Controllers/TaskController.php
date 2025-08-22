<?php

namespace App\Http\Controllers;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use App\Http\Resources\TaskResource;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::query();

        //Search by title
        if ($request->filled('search')) {
            $tasks->where('title', 'like', '%' . $request->search . '%');
        }

        //filter by priority
        if ($request->filled('priority')) {
            $tasks->where('priority', $request->priority);
        }

        //sorting
        if ($request->filled('sort_by')) {
            $tasks->orderBy($request->sort_by, $request->sort_direction ?? 'asc');
        }

        //pagination
        $tasks = $tasks->paginate(10);

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $task = Task::create($request->validated());
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $id)
    {
        $task = Task::findOrFail($id);

        $task->update($request->validated());

        return new TaskResource($task);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Task soft deleted']);
    }

    //restore
    public function restore(string $id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();

        return new TaskResource($task);
    }

    //force delete
    public function forceDelete(string $id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        $task->forceDelete();

        return response()->json(['message' => 'Task permanently deleted']);
    }
}
