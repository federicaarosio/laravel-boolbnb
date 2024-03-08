<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    private $rules = [
        'user_id' => ['exists:users,id'],
        'category_id' => ['exists:categories,id'],
        'title' => ['required', 'string', 'max:80'],
        'description' => ['required', 'string'],
        'room_number' => ['required', 'numeric', 'min:1'],
        'bed_number' => ['required', 'numeric', 'min:1'],
        'toilet_number' => ['required', 'numeric', 'min:1'],
        'square_meters' => ['required', 'numeric', 'min:1'],
        'img_url' => ['required', 'string', 'url:http,https'],
        'is_visible' => [],
        'address' => ['required'],
        'longitude' => ['decimal:6'],
        'latitude' => ['decimal:6'],
        'services' => ['array'],
    ];

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
        $services = Service::all();
        return view('apartments.create', compact('apartment', 'categories', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules);
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
        $apartment = Apartment::create($data);
        $apartment->services()->sync($data['services']);
        return to_route('apartments.show', $apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        if($apartment->user_id != Auth::id()) {
            return to_route('apartments.index')->with('message', 'Non sei Autorizzato! cretino');
        } else {
            return view('apartments.show', compact('apartment'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        if($apartment->user_id != Auth::id()) {
            return to_route('apartments.index')->with('message', 'Non sei Autorizzato! cretino');
        }
        $categories = Category::all();
        $services = Service::all();
        return view('apartments.edit', compact('apartment', 'categories', 'services'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $data = $request->validate($this->rules);
        $data['is_visible'] = isset($data['is_visible']);

        if($data['address'] != $apartment->address) {
            $apiKey = env('TOMTOM_API_KEY');
            $addressQuery = str_replace(' ', '+', $data['address']);

            $coordinate = "https://api.tomtom.com/search/2/geocode/{$addressQuery}.json?key={$apiKey}";

            $json = file_get_contents($coordinate);
            $obj = json_decode($json);
            $lat = $obj->results[0]->position->lat;
            $lon = $obj->results[0]->position->lon;

            $data['latitude'] = $lat;
            $data['longitude'] = $lon;
        }

        $apartment->update($data);
        if (!isset($data['services'])){
            $data['services'] = [];
        }
        $apartment->services()->sync($data['services']);

        return redirect()->route('apartments.show', $apartment);
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
