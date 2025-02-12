<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'user_id'=> $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'image_data' => $this->image_data ? base64_encode($this->image_data) : null,
            'phone'=>$this->phone_number,
            'group_id'=>$this->group_id,
            'group_name' => $this->group ? $this->group->name : null,
        ];
    }
}
