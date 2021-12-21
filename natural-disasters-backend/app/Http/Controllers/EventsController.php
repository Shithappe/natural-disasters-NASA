<?php

namespace App\Http\Controllers;

use App\Models\events;
use App\Http\Requests\StoreeventsRequest;
use App\Http\Requests\UpdateeventsRequest;
use Illuminate\Support\Facades\Http;


class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function set_events()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get('https://eonet.gsfc.nasa.gov/api/v2.1/events?api_key=yjUjEyzPh5dAhJQMqxu6b6HOTbrs4GGyWGsXBsqj');
    
        $response = json_decode($response)->events; //arr of events

        
        foreach ($response as $i){
 
            $events = Events::create([
                'title' => $i->title,
                'categories_id' => $i->categories[0]->id,
                'date' => $i-> geometries[0]->date,
                'coordinates' => $i->geometries[0]->coordinates[1] . ',' . $i->geometries[0]->coordinates[0]
            ]);
        }
        return response('Seted Events', 201);

    }

    public function get_events(){
        return Events::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreeventsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreeventsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateeventsRequest  $request
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateeventsRequest $request, events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(events $events)
    {
        //
    }
}
