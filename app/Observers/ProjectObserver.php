<?php

namespace App\Observers;

use App\Models\Project;

// queste classi andranno poi richiamate in EventServiceProvider.php

class ProjectObserver       // permette di usare le funzioni specificate in questa classe dato un determinato evento all'interno del model
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        $project->members()->attach([$project->creator_id]);
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     */
    public function restored(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     */
    public function forceDeleted(Project $project): void
    {
        //
    }
}
