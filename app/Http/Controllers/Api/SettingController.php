<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResources\SettingsList;
use App\Models\Setting;
use Illuminate\Http\Request;
use Throwable;

class SettingController extends Controller
{
    public function index()
    {
        try {

            return SettingsList::collection(Setting::all());

        } catch (Throwable $e) {

            report($e);
            return response()->json(['message' => 'Nastala chyba při načítání nastavení'], 500);

        }
    }

}
