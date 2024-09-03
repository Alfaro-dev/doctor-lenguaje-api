<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'current_progress' => $this->relationLoaded('progress') ? new ProgressResource($this->progress->last()) : null,
            'progress' => $this->relationLoaded('progress') ? ProgressResource::collection($this->progress) : null,
            'experiences' => $this->relationLoaded('experiences') ? new ExperienceResource($this->experiences->last()) : null,
            'permissions' => $this->relationLoaded('permissions') ? PermissionResource::collection($this->permissions) : null,
        ];
    }
}
