<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'books' => [
                'categoria_id' => $this->books->categoria_id,
                'nome' => $this->books->nome
            ],
            'nome' => $this->nome,
            'id' => $this->id
        ];
    }
}
