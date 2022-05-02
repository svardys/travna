<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublicResources\FieldsList;
use App\Models\Field;
use Illuminate\Http\Request;
use Throwable;

class FieldController extends Controller
{

    public function index()
    {

        try {

            return FieldsList::collection(Field::all());

        } catch (Throwable $e) {

            report($e);
            return response()->json(['message' => 'Nastala chyba při načítání nastavení'], 500);

        }
    }

    public function update(Request $request)
    {

        try {

            $edit = Field::where('name', '=', $request->name)->firstOrFail();

            $edit->value = $request->text;

            $edit->save();

            return response()->json(['message' => 'Data se úspěšně uložila']);

        } catch (Throwable $e) {

            report($e);
            return response()->json(['message' => 'Nastala chyba při ukládání'], 500);
        }
    }
}
