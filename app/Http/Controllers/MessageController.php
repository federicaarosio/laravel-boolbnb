<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $messages = Message::where('apartment_id', $request['apartment_id'])->with('apartment')->get();
        // dd($messages);
        if($messages[0]->apartment->user_id != Auth::id()) {
            return to_route('apartments.index')->with('message', 'Non sei Autorizzato!');
        } else {
            return view('Messages.index', compact('messages'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function destroy(Message $message, Request $request)
    {
        $message->delete();
        if($request['index']) {
            return to_route('messages.index');
        }
        return back();
    }
}
