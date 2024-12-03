<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class for configuration data to return
 */
class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'company_id' => $this->company_id,
            'name'       => $this->name,
            'surname'    => $this->surname,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'created_at' => ($this->created_at ? $this->created_at->format('Y-m-d H:i:s') : $this->created_at),
        ];
    }
}
