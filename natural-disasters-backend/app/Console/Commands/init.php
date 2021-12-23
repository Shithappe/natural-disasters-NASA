<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use App\Models\categories;
use App\Models\events;


class init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

        /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('migrate:refresh');   
        $this->set_categories();
        $this->set_events();
    }


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

    public function set_categories()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get('https://eonet.gsfc.nasa.gov/api/v2.1/categories?api_key=yjUjEyzPh5dAhJQMqxu6b6HOTbrs4GGyWGsXBsqj');
    
        $response = json_decode($response)->categories;
               
        foreach ($response as $i){

            $categories = Categories::create([
                'id' => $i->id,
                'title' => $i->title
            ]);
        }
        return response('Seted Categories', 201);
    }
}
