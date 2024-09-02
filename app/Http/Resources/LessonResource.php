<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'title' => $this->title,
            'order' => $this->order,
            'description' => $this->description,
            'grammar_topic' => $this->grammar_topic,
            'experience_points' => $this->experience_points,
            'objective' => $this->objective,
            'vocabulary' => $this->vocabulary,
            'verbs' => $this->verbs,
            'native_expression' => $this->native_expression,
            'content' => $this->content,
        ];
    }
}
