<?php

namespace App\Http\Controllers;

use App\Master;
use App\Outfit;
use Illuminate\Http\Request;
use Validator;

class OutfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $masters = Master::all();

        // Sortiravimas ir filtravimas start
        $sort = $request->get('sort', '');
        $filter = $request->get('filter', '');

        if ($sort == 'a-z') {
            $outfits = Outfit::orderBy('color')->get(); // db 
            $sort = 'z-a';
        } elseif ($sort == 'z-a') {
            $outfits = Outfit::orderBy('color', 'desc')->get(); // db
            $sort = 'a-z';
        } elseif ($filter) {
            $outfits = Outfit::where('master_id', $filter)->get(); // db

        } else {
            $outfits = Outfit::all();
        }

        return view('outfit.index', [
            'outfits' => $outfits,
            'masters' => $masters,
            'filter' => $filter ?? 0,
            'sort' => $sort
        ]);

        // Sortiravimas ir filtravimas end
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masters = Master::all();
        return view('outfit.create', ['masters' => $masters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),

            [
                'outfit_type' => ['required', 'min:3', 'max:64'],
                'outfit_color' => ['required', 'min:3', 'max:64'],
                'outfit_size' => ['required', 'min:1', 'max:100'],
                'outfit_about' => ['required', 'min:3', 'max:255']
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->route('outfit.create')->withErrors($validator);
        }


        $outfit = new Outfit;
        $outfit->type = $request->outfit_type;
        $outfit->color = $request->outfit_color;
        $outfit->size = $request->outfit_size;
        $outfit->about = $request->outfit_about;
        $outfit->master_id = $request->master_id;
        $outfit->save();
        return redirect()->route('outfit.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function show(Outfit $outfit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function edit(Outfit $outfit)
    {
        $masters = Master::all();
        return view('outfit.edit', ['outfit' => $outfit, 'masters' => $masters]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outfit $outfit)
    {
        $outfit->type = $request->outfit_type;
        $outfit->color = $request->outfit_color;
        $outfit->size = $request->outfit_size;
        $outfit->about = $request->outfit_about;
        $outfit->master_id = $request->master_id;
        $outfit->save();
        return redirect()->route('outfit.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outfit $outfit)
    {
        $outfit->delete();
        return redirect()->route('outfit.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
