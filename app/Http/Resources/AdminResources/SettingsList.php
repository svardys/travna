<?php

namespace App\Http\Resources\AdminResources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsList extends JsonResource
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
            'showAlert'                     => $this->show_alert,
            'minReservationNights'          => $this->min_reservation_nights,
            'maxReservationNights'          => $this->max_reservation_nights,
            'priceNight'                    => $this->price_night,
        ];
    }
}
