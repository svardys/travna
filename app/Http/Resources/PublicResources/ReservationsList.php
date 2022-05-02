<?php

namespace App\Http\Resources\PublicResources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ReservationsList extends JsonResource
{

    public function toArray($request)
    {
        return [
            'start'         => Carbon::parse($this->start)->format('Y-m-d'),
            'end'           => Carbon::parse($this->end)->format('Y-m-d')
        ];
    }
}
