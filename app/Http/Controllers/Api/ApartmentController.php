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
        if($request['rooms'] == 0 && $request['beds'] == 0) {
            $apartments = Apartment::with('user')->get();
        } elseif($request->has('beds') && $request['beds'] != 0 && $request->has('rooms') && $request['rooms'] != 0) {
            $apartments = Apartment::with('user')
            ->where('bed_number', $request['beds'])
            ->where('room_number', $request['rooms'])
            ->get();
        } elseif($request->has('beds') && $request['beds'] != 0) {
            $apartments = Apartment::where('bed_number', $request['beds'])->with('user')->get();
        } else {
            $apartments = Apartment::where('room_number', $request['rooms'])->with('user')->get();
        }

      //  $ids = [1,2,3];

//$apartments = Apartment::whereHas('services', function ($query) use ($ids) {
          //  $query->whereIn('service_id', $ids);
      //  })->with('services')->get();

       // dd($apartments);


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
        $apartments = Apartment::with('category', 'services')->findOrFail($id);
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
