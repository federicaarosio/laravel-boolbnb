<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::all();
        return view('Apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apartment = new Apartment();
        $categories = Category::all();
        return view('apartments.create', compact('apartment', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request;
        $data['user_id'] = Auth::id();
        $data['is_visible'] = true;

        $apiKey = env('TOMTOM_API_KEY');
        $addressQuery = str_replace(' ', '+', $data['address']);

        $coordinate = "https://api.tomtom.com/search/2/geocode/{$addressQuery}.json?key={$apiKey}";

        $json = file_get_contents($coordinate);
        $obj = json_decode($json);
        $lat = $obj->results[0]->position->lat;
        $lon = $obj->results[0]->position->lon;

        $data['latitude'] = $lat;
        $data['longitude'] = $lon;
        $apartment = Apartment::create($data->all());
        return to_route('apartments.create', $apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
