<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::query();

        //Search by name
        if ($request->filled('search')) {
            $projects->where('name', 'like', '%' . $request->search . '%');
        }

        //filter by status
        if ($request->filled('status')) {
            $projects->where('status', $request->status);
        }

        //sorting
        if ($request->filled('sort_by')) {
            $projects->orderBy($request->sort_by, $request->sort_direction ?? 'asc');
        }

        //pagination
        $projects = $projects->paginate(10);

        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(ProjectStoreRequest $request)
    {
        $project = Project::create($request->validated());
        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('tasks.users')->findOrFail($id);
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
      public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->update($request->validated());
        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(['message' => 'Project soft deleted']);
    }

    //restore
    public function restore(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return new ProjectResource($project);
    }

    //force delete
    public function forceDelete(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->forceDelete();

                return response()->json(['message' => 'Project permanently deleted']);

    }
}
