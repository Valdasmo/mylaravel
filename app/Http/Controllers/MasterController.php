<?php

namespace App\Http\Controllers;

use App\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masters = Master::all();
        return view('master.index', ['masters' => $masters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $master = new Master;
        $master->name = $request->master_name;
        $master->surname = $request->master_surname;
        $master->save();
        return redirect()->route('master.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function show(Master $master)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function edit(Master $master)
    {
        return view('master.edit', ['master' => $master]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Master $master)
    {
        $master->name = $request->master_name;
        $master->surname = $request->master_surname;
        $master->save();
        return redirect()->route('master.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function destroy(Master $master)
    {
        if($master->masterOutfits->count()){
            return redirect()->route('master.index')->with('info_message', 'Trinti negalima, nes turi drabužių.');

            // return 'Trinti negalima, nes turi drabužių';
        }
 
        $master->delete();
        return redirect()->route('master.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
