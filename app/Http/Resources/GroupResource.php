<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            'id'=>$this->id,
            'name' => $this->name,
            'staffs'=>GroupStaffResource::collection($this->staffs),
            'child_profiles'=>FamilyAccountChildProfileResource::collection($this->child_profiles),
        ];
    }
}
