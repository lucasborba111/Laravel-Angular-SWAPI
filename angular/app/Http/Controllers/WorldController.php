<?php

namespace App\Http\Controllers;

use App\Models\World;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;
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
            $response = Http::get('https://swapi.dev/api/planets?page=1')->json('results');
            foreach($response as $item => $value){
                $filmes='';
                preg_match_all('!\d+!', implode($value['films']), $matches);
                $ids = implode($matches[0]);
                $url = "https://swapi.dev/api/films/";

                $people='';
                preg_match_all('!\d+!', implode($value['residents']), $people_match);
                $people_ids = implode(',',$people_match[0]);
                $people_url = "https://swapi.dev/api/people/";

                foreach($matches as $valor=>$index){
                    for($i=0;$i<count($index);$i++){
                        $response2=Http::get($url.$matches[$valor][$i].'/')->json('title');
                        $filmes .= $response2.'.';

                    }         
                    for($i=0;$i<count($index);$i++){
                        $response2=Http::get($people_url.$matches[0][$i].'/')->json('name');
                        $people .= $response2.',';
                    }               
                }
            World::create(['name'=>$value['name'],
                        'rotation_period'=>$value['rotation_period'],
                        'orbital_period'=>$value['orbital_period'], 
                        'diameter'=>$value['diameter'] ,
                        'films'=> $filmes,
                        'films_id'=>$ids,
                        'climate'=>$value['climate'],
                        'population'=>$value['population'],
                        'people'=>$people,
                        'people_id'=>$people_ids
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
     * @param  integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->world->find($id);
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
