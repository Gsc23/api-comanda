<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'success' => false,
            'data' => [
                'message' => $this->resource['message'] ?? 'Unknown error',
                'status' => $this->resource['status'] ?? 500,
            ],
        ];
    }
}
