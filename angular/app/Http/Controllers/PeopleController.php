<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\People;
use App\Models\Movie;
class PeopleController extends Controller
{
    public function __construct(People $people)
    {
        $this->people = $people;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->people->all();

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
        $total = $this->people->all();

        if($total->pluck('items')->toArray()==null){
            $response = Http::get('https://swapi.dev/api/people?page=1')->json('results');
            foreach($response as $item => $value){
                $filmes='';
                preg_match_all('!\d+!', implode($value['films']), $matches);

                $ids = implode($matches[0]);
                $url = "https://swapi.dev/api/films/";
                foreach($matches as $valor=>$index){
                    for($i=0;$i<count($index);$i++){
                        $response2=Http::get($url.$matches[$valor][$i].'/')->json('title');
                        $filmes .= $response2.'.';
                    }                   
                }
            People::create([
                            'name'=>$value['name'],
                            'birth_year'=>$value['birth_year'],
                            'gender'=>$value['gender'],
                            'films'=>$filmes,
                            'films_id'=>$ids
                        ]);
    }
            return PeopleController::index();
    }
        else{
            return PeopleController::index();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->people->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
