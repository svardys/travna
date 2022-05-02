<?php

namespace App\Rules;

use App\Models\Reservation;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class ReservationDate implements Rule
{
    public $start_date;
    public $end_date;
    public $current_date;
    /**
     * @var Carbon
     */
    private $year_from_now;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start_date, $end_date)
    {
        $this->start_date = Carbon::parse($start_date);
        $this->end_date = Carbon::parse($end_date);
        $this->current_date = Carbon::now()->startOfDay();
        $this->year_from_now = Carbon::now()->startOfDay()->addYear();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if($this->start_date >= $this->end_date){
            return false;
        }elseif ($this->start_date < $this->current_date){
            return false;
        }elseif ($this->start_date > $this->year_from_now){
            return false;
        }
        else {
            return Reservation::whereDate('start', '>=', $this->start_date)
                ->whereDate('end', '<=', $this->end_date)->doesntExist();
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nevalidní rezervace';
    }
}
