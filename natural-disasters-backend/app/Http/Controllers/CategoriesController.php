<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Http\Requests\StorecategoriesRequest;
use App\Http\Requests\UpdatecategoriesRequest;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\events;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function set_categories()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get('https://eonet.gsfc.nasa.gov/api/v2.1/categories?api_key=yjUjEyzPh5dAhJQMqxu6b6HOTbrs4GGyWGsXBsqj');
    
        $response = json_decode($response)->categories;
       
        $res = [];
        
        foreach ($response as $i){
 
            array_push($res, $i);

            $categories = Categories::create([
                'id' => $i->id,
                'title' => $i->title
            ]);
        }
        return $res;
    }

    public function get_categories(){
        return Categories::select('title')->get();
    }


    public function get_category_id(Request $request){
        $category = Categories::where('title', $request->category)->get();
        $id = $category[0]->id;

        $events = Events::where('categories_id', $id)->get();
        return $events;
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
     * @param  \App\Http\Requests\StorecategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecategoriesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoriesRequest  $request
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoriesRequest $request, categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(categories $categories)
    {
        //
    }
}
