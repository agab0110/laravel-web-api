<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array        // classe per il ritorno
    {
        $data = parent::toArray($request);
        $data['status'] = $this->completed ? 'finished' : 'open';   // lo "status" viene impostato a "finished" o "open" nel caso completed sia vero o falso

        return $data;
    }
}
