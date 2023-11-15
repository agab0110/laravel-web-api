<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectCollectionResource;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class ProjectController extends Controller
{
    public function index(Request $request) {
        $projects = QueryBuilder::for(Project::class)       // fa in modo che vengano incluse le task e pagina l'output
                                    ->allowedIncludes('tasks')
                                    ->paginate();

        return new ProjectCollectionResource($projects);
    }

    public function store(StoreProjectRequest $request) {
        $validated = $request->validated();

        $project = Auth::user()->projects()->create($validated);        // crea la relazione tra project e user

        return new ProjectResource($project);
    }

    public function show(Request $request, Project $project) {
        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, Project $project) {
        $validated = $request->validated();

        $project->update($validated);       // aggiorna il campo nel database

        return new ProjectResource($project);
    }
}
