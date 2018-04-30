<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'is_valid' => $this->is_valid,
            'id_pl' => $this->id_pl,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
