<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function store(StoreProjectRequest $request) {
        $validated = $request->validated();

        $project = Auth::user()->projects()->create($validated);        // crea la relazione tra project e user

        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, Project $project) {
        $validated = $request->validated();

        $project->update($validated);       // aggiorna il campo nel database

        return new ProjectResource($project);
    }
}
