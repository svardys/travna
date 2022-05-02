<?php

namespace App\Http\Resources\AdminResources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationsList extends JsonResource
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
            'id'            => $this->id,
            'start'         => $this->start,
            'end'           => $this->end,
            'name'          => $this->name,
            'surname'       => $this->surname,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'adult_count'   => $this->adult_count,
            'child_count'   => $this->child_count,
            'pet'           => $this->pet,
            'color'         => $this->id % 2 == 0
        ];
    }
}
