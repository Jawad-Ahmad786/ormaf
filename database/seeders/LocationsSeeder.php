<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use JsonMachine\Items;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $filePath = storage_path('app/json/countries_states_cities.json');
        $countries = Items::fromFile($filePath);

     foreach ($countries as $country) {
         Country::upsert([
            [
                'name' => $country->name,
                'phonecode' => $country->phonecode
              ],
         ], 'name');

         $countryRecord =  Country::where('name', $country->name)->first();

     foreach ($country->states as $state) {
                State::upsert([
                    [
                        'country_id' => $countryRecord->id,
                        'name' => $state->name
                    ],
                ], ['name', 'country_id']);

           $stateRecord =  State::where('name', $state->name)->first();
           $cities = [];
     foreach ($state->cities as $city) {
                $cities[] = [
                    'state_id' => $stateRecord->id,
                    'name' => $city->name
                ];
             }
             City::upsert($cities, ['name', 'state_id']);
         }
     }

    }
}
