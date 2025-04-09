<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'success' => true,
            'message' => $this->resource['user'] ?? 'Success',
            'status' => $this->resource['status'] ?? 200,
        ];
    }
}
