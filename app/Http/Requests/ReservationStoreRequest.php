<?php

namespace App\Http\Requests;

use App\Rules\ReservationDate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reservationRange_end' => ['required', 'date'],
            'reservationRange_start' => ['required', 'date', new ReservationDate($this->reservationRange_start, $this->reservationRange_end)],
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'email' => 'required|email',
            'phone' => 'required|string',
            'adultCount' => 'required|numeric|min:1|max:4',
            'childCount' => 'required|numeric|max:4',
            'pet' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'reservationRange_start.required' => 'Povinné pole',
            'reservationRange_start.date' => 'Nevalidní hodnota',
            'reservationRange_end.required' => 'Povinné pole',
            'reservationRange_end.date' => 'Nevalidní hodnota',
            'name.required' => 'Povinné pole',
            'name.alpha' => 'Nepovolenné znaky',
            'surname.required' => 'Povinné pole',
            'surname.alpha' => 'Nepovolenné znaky',
            'email.required' => 'Povinné pole',
            'email.email' => 'Nevalidní email',
            'phone.required' => 'Povinné pole',
            'phone.string' => 'Nepovolenné znaky',
            'adultCount.required' => 'Povinné pole',
            'adultCount.numeric' => 'Nepovolenné znaky',
            'adultCount.min' => 'Minimální počet je: 1',
            'adultCount.max' => 'Maximální počet je: 4',
            'childCount.required' => 'Povinné pole',
            'childCount.numeric' => 'Nepovolenné znaky',
            'childCount.max' => 'Maximální počet je: 4',
            'pet.string' => 'Nevalidní hodnota',
        ];
    }
}
