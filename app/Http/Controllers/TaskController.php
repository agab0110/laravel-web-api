<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index() {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters('completed')   // aggiunge un filtro per completezza, da postman, alla fine dell'url, va inserito "?filter[campo da filtrare]=qualcosa
            ->defaultSort('created_at')     // fa un sort per data di creazione, mettendo un "-" prima di "created_at" il sort viene fatto nel verso opposto
            ->paginate();   // pagina i risultati, in una pagina ci sono al massimo 15 record

        return new TaskCollection($tasks);
    }

    public function show(Request $request, Task $task) {
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request) {
        $validated = $request->validated();

        $task = Task::create($validated);

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task) {
        $validated = $request->validated();

        $task->update($validated);

        return new TaskResource($task);
    }

    public function destroy(Request $request, Task $task) {
        $task->delete();

        return response("Task removed", 200);
    }
}
