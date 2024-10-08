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
    public function __construct() {     // costruttore per autorizzare con una policy le richieste per la classe project
        $this->authorizeResource(Project::class, 'project');
    }

    public function index(Request $request) {
        $projects = QueryBuilder::for(Project::class)       // fa in modo che vengano incluse le task e pagina l'output
                                    ->allowedIncludes('tasks')      // include le tasks se vengono richieste dall'url
                                    ->paginate();

        return new ProjectCollectionResource($projects);    // qui le task e i members non verranno visualizzate poiché non sono caricati
    }

    public function store(StoreProjectRequest $request) {
        $validated = $request->validated();

        $project = Auth::user()->projects()->create($validated);        // crea la relazione tra project e user

        return new ProjectResource($project);
    }

    public function show(Request $request, Project $project) {
        return (new ProjectResource($project))
            ->load('tasks')      // qui le task verranno visualizzate poiché sono caricate
            ->load('members');      // carica i members in modo tale che vengano visualizzati
    }

    public function update(UpdateProjectRequest $request, Project $project) {
        $validated = $request->validated();

        $project->update($validated);       // aggiorna il campo nel database

        return new ProjectResource($project);
    }

    public function destroy(Request $request, Project $project) {
        $project->delete();     // elimina il campo nel database

        return response("Project deleted succesfully", 200);
    }
}
