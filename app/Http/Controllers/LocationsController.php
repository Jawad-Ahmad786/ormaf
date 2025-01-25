<?php

namespace App\Http\Controllers;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Log;

class LocationsController extends Controller
{
    public function getStates(string $locale, $countryId)
    {
        $states = State::where('country_id', $countryId)->get(['id', 'name']);
        return response()->json($states);
    }

    public function getCities(string $locale, $stateId)
    {
        $cities = City::where('state_id', $stateId)->get(['id', 'name']);
        return response()->json($cities);
    }
}
