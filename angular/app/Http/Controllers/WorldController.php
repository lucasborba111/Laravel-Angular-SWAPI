<?php

namespace App\Http\Controllers;

use App\Models\World;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class WorldController extends Controller
{
    public function __construct(World $world)
    {
        $this->world = $world;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->world->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total = $this->world->all();
   
        if($total->pluck('items')->toArray()==null){
            $response = Http::get('https://swapi.dev/api/planets/')->json('results');
            foreach($response as $item => $value){
            World::create(['name'=>$value['name'],
                        'rotation_period'=>$value['rotation_period'],
                        'orbital_period'=>$value['orbital_period'], 
                        'diameter'=>$value['diameter'] ,
                        'films'=>implode(',',$value['films']), 
                        'climate'=>$value['climate'],
                        'population'=>$value['population'],
                        'residents'=>implode(',',$value['residents']),
                        ]);
                    }
            return WorldController::index();

        }
        else{
            return WorldController::index();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\World  $world
     * @return \Illuminate\Http\Response
     */
    public function show(World $world)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\World  $world
     * @return \Illuminate\Http\Response
     */
    public function edit(World $world)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\World  $world
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, World $world)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\World  $world
     * @return \Illuminate\Http\Response
     */
    public function destroy(World $world)
    {
        //
    }
}
