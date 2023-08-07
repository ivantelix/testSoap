<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'success' => $this->resource['success'],
            'code' => $this->resource['code'],
            'message' => $this->resource['message_error'] ?? $this->resource['message_success'],
            'data' => $this->resource['data']
        ];
    }
}
