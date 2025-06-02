<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AsteroidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'discovered_date' => $this->discovered_date,
            'mineral_content' => $this->mineral_content,
            'corporation_name' => $this->corporation->name,
            'index' => $this->index,
            'leader_name' => $this->leader->leader_name,
        ];
    }
}
