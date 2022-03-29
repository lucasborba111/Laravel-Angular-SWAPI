<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\World;
use App\Http\Controllers\WorldController;
class MovieController extends Controller
{
    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->movie->all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total = $this->movie->all();
        if($total->pluck('items')->toArray()==null){
            $response = Http::get('https://swapi.dev/api/films?page=1')->json('results');
            foreach($response as $item => $value){
                $worlds='';
                preg_match_all('!\d+!', implode($value['planets']), $matches);
                $ids = implode($matches[0]);
                $url = "https://swapi.dev/api/planets/";

                $people='';
                preg_match_all('!\d+!', implode($value['characters']), $people_match);
                $people_ids = implode(',',$people_match[0]);
                $people_url = "https://swapi.dev/api/people/";

                foreach($matches as $valor=>$index){
                    for($i=0;$i<count($index);$i++){
                        $response2=Http::get($url.$matches[$valor][$i].'/')->json('name');
                        $worlds .= $response2.',';
                    }   
                    
                    for($i=0;$i<count($index);$i++){
                        $response2=Http::get($people_url.$matches[0][$i].'/')->json('name');
                        $people .= $response2.',';
                    }      
                }

                Movie::create(['title'=>$value['title'],
                            'episode_id'=>$value['episode_id'],
                            'opening_crawl'=>$value['opening_crawl'], 
                            'release_date'=>$value['release_date'] ,
                            'planets'=>$worlds,
                            'planets_id'=>$ids,
                            'people'=>$people,
                            'people_id'=>$people_ids
                            ]);
                    }
            return MovieController::index();
        }
        else{
            return MovieController::index();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id;
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->movie->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
