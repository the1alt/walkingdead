<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Characteres;

class CharactereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null) {
        if ($id == null) {
            return Characteres::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $birth_date = strtotime($request->input('birth_date'));
        $birth_date = date('Y-m-d', $birth_date);

        $charactere = new Characteres;

        $charactere->pseudo = $request->input('pseudo');
        $charactere->sexe = $request->input('sexe');
        $charactere->photo = $request->input('photo');
        $charactere->activity = $request->input('activity');
        $charactere->birth_date = $birth_date;
        $charactere->latitude = $request->input('latitude');
        $charactere->longitude = $request->input('longitude');
        $charactere->state = $request->input('state');
        $charactere->resume = $request->input('resume');
        if ($request->input('saison') == null){
            $charactere->saison = "1,2,3,4,5,6,7";
        }else{
            $charactere->saison = $request->input('saison');
        }
        $charactere->save();

        return 'charactere record successfully created with id ' . $charactere->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Characteres::find($id);
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

        $birth_date = strtotime($request->input('birth_date'));
        $birth_date = date('Y-m-d', $birth_date);
        
        $charactere = Characteres::find($id);

        $charactere->pseudo = $request->input('pseudo');
        $charactere->sexe = $request->input('sexe');
        $charactere->photo = $request->input('photo');
        $charactere->activity = $request->input('activity');
        $charactere->birth_date = $birth_date;
        $charactere->latitude = $request->input('latitude');
        $charactere->longitude = $request->input('longitude');
        $charactere->state = $request->input('state');
        $charactere->resume = $request->input('resume');
        if ($request->input('saison') == null){
            $charactere->saison = "1,2,3,4,5,6,7";
        }else{
            $charactere->saison = $request->input('saison');
        }
        $charactere->save();

        return "Sucess updating " . $charactere->pseudo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $charactere = Characteres::find($id);

        $charactere->delete();

        return $charactere->pseudo." has been eating";
    }
}
