<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [        // mostra le informazioni elencate sotto
            'id' => $this->id,
            'title' => $this->title,
            'tasks' => TaskResource::collection($this->tasks),      // mostra una collection di task collegate al project
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
