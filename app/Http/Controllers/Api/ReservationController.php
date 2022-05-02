<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Resources\PublicResources\ReservationsList as PublicReservationsList;
use App\Http\Resources\AdminResources\ReservationsList as AdminReservationsList;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Throwable;

class ReservationController extends Controller
{
    public function index()
    {
        try {

            $start_date = Carbon::now()->startOfMonth();
            $start_date->subDays( $start_date->dayOfWeekIso - 1);

            return PublicReservationsList::collection(Reservation::whereDate('end','>=', $start_date)->orderBy('start', 'asc')->get());

        } catch (Throwable $e) {

            report($e);
            return response()->json(['message' => 'Nastala chyba při načítání rezervací'], 500);

        }
    }

    public function adminIndex()
    {
        try {

            return AdminReservationsList::collection(Reservation::orderBy('start', 'asc')->get());

        } catch (Throwable $e) {

            report($e);
            return response()->json(['message' => 'Nastala chyba při načítání rezervací'], 500);

        }

    }

    public function store(ReservationStoreRequest $request)
    {

        try {

            $reservation = new Reservation();

            $reservation->start = $request->reservationRange_start;
            $reservation->end = $request->reservationRange_end;
            $reservation->name = $request->name;
            $reservation->surname = $request->surname;
            $reservation->email = $request->email;
            $reservation->phone = $request->phone;
            $reservation->adult_count = $request->adultCount;
            $reservation->child_count = $request->childCount;
            $reservation->pet = $request->pet === 'true' ? '1': '0';

            $reservation->save();

            return response()->json(['message' => 'Úspěšně jste se rezervovali. V uvedeném emailu naleznete informace o Vaší rezervaci.']);

        } catch (Throwable $e) {

            report($e);
            return response()->json(['message' => 'Nastala chyba při rezervování'], 500);

        }
    }
}
