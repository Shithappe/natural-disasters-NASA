<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\Http\Requests\StoretestRequest;
use App\Http\Requests\UpdatetestRequest;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $response = Http::get('https://eonet.gsfc.nasa.gov/api/v2.1/events?api_key=yjUjEyzPh5dAhJQMqxu6b6HOTbrs4GGyWGsXBsqj');


        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get('https://eonet.gsfc.nasa.gov/api/v2.1/categories?api_key=yjUjEyzPh5dAhJQMqxu6b6HOTbrs4GGyWGsXBsqj');
    
        $response = json_decode($response)->categories;

       
        $res = [];
        
        foreach ($response as $i){
 
            array_push($res, $i);

            $categories = Categoies::create([
                'id' => $i->id,
                'title' => $i->title
            ]);
        }
        return $res;

        // $response = json_decode($response)->events;
        // $res = [];
        // foreach ($response as $i){
        //     array_push($res, $i->title);
        // }
        // return $res;
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
     * @param  \App\Http\Requests\StoretestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetestRequest  $request
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetestRequest $request, test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(test $test)
    {
        //
    }
}
