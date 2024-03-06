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
        $apartments = Apartment::where('user_id', Auth::id())->get();
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
    public function show(Apartment $apartment)
    {
        return view('Apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        $categories = Category::all();
        return view('apartments.edit', compact('apartment', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $data = $request;
        $data['user_id'] = Auth::id();
        $apartment->update($data());

        return redirect()->route('apartments.edit', $apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return to_route('apartments.index');
    }
}
