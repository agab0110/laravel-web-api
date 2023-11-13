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
            ->allowedSorts(['title', 'completed', 'created_at'])    // fa fare un sort per i parametri specificati, basta aggiungere "?sort=parametro" alla fine dell'url, con - prima del parametro di inverte l'ordine
            ->paginate();   // pagina i risultati, in una pagina ci sono al massimo 15 record

        return new TaskCollection($tasks);
    }

    public function show(Request $request, Task $task) {        // metodo per prendere un solo record, basta passare l'id e si riceverà la task desiderata
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request) {      // metodo per inserire una nuova task
        $validated = $request->validated();     // validazione dei campi, vedere le rules della classe "StoreTaskRequest"

        $task = Task::create($validated);       // "Task::create" serve a salvare nel database

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task) {        // metodo per l'update di una task, anche qui serve solo l'id
        $validated = $request->validated();     // validazione dei campi, vedere le rules della classe "UpdateTaskRequest"

        $task->update($validated);      // aggiornamento nel database

        return new TaskResource($task);
    }

    public function destroy(Request $request, Task $task) {     // metodo per l'eliminazione di una task, anche qui basta solo l'id
        $task->delete();        // elimina la task dal database

        return response("Task removed", 200);
    }
}
