<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEditApartmentRequest;
use App\Models\Apartment;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->with('messages')->get();
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
    public function store(StoreEditApartmentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['is_visible'] = isset($data['is_visible']);

        if($data['imageOrUrl'] == 'file') {
            $imageSrc = Storage::put('uploads/Apartments', $data['img_url']);
            $imageUrl = Storage::url($imageSrc);
            $data['img_url'] = $imageUrl;
        }

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
        // $apartment['img_url'] = Storage::url($apartment['img_url']);
        if($apartment->user_id != Auth::id()) {
            return to_route('apartments.index')->with('message', 'Non sei Autorizzato!');
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
            // return to_route('apartments.index')->with('message', 'Non sei Autorizzato!');
            return view('pages.error');
        }
        $categories = Category::all();
        $services = Service::all();
        return view('apartments.edit', compact('apartment', 'categories', 'services'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEditApartmentRequest $request, Apartment $apartment)
    {
        $data = $request->validated();
        $data['is_visible'] = isset($data['is_visible']);
        if($data['imageOrUrl'] == 'file') {
            if(empty($data['img_url'])) {
                $data['img_url'] = $apartment->img_url;
            } else {
                $imageSrc = Storage::put('uploads/Apartments', $data['img_url']);
                $data['img_url'] = $imageSrc;
            }
        }

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
