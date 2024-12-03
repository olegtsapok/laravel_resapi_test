<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class for configuration data to return
 */
class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'nip'         => $this->nip,
            'address'     => $this->address,
            'city'        => $this->city,
            'postal_code' => $this->postal_code,
            'created_at'  => ($this->created_at ? $this->created_at->format('Y-m-d H:i:s') : $this->created_at),
        ];
    }
}
