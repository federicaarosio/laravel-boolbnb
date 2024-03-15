<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Apartment::query();

        if($request->has('beds') && $request['beds'] != 0) {
            $query->where('bed_number', '>=', $request['beds']);
        }

        if($request->has('rooms') && $request['rooms'] != 0) {
            $query->where('room_number', '>=', $request['rooms']);
        }

        if($request->has('services') && $request['services'] != []) {
            $services = $request['services'];
            $query->whereHas('services', function ($q) use ($services) {
                $q->whereIn('service_id', $services);
            }, '=', count($services));
        }

        if($request->has('address') && $request['address'] != "") {
            $apiKey = env('TOMTOM_API_KEY');
            $addressQuery = str_replace(' ', '+', $request['address']);

            $coordinate = "https://api.tomtom.com/search/2/geocode/{$addressQuery}.json?key={$apiKey}";
            $json = file_get_contents($coordinate);
            $obj = json_decode($json);

            $lat = $obj->results[0]->position->lat;
            $lon = $obj->results[0]->position->lon;

            $query->whereRaw('ST_Distance( POINT(apartments.longitude, apartments.latitude),POINT(' . $lon . ',' . $lat . ')) < ' . $request['range'] / 100);
        }

        $apartments = $query->with('user', 'services', 'sponsors')->get()->toArray();
        
        $sponsoredApartment = [];
        
        foreach ($apartments as $index => $apartment) {
            if ($apartment['sponsors'] != []) {
                unset($apartments[$index]);
                array_push($sponsoredApartment, $apartment);
            }
        }

        foreach($sponsoredApartment as $sa) {
            array_unshift($apartments, $sa);
        }

        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $apartments = Apartment::with('category', 'services', 'user', 'sponsors')->findOrFail($id);
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
