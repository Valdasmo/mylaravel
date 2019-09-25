<?php

namespace App\Http\Controllers;

use App\Master;
use App\Outfit;
use Illuminate\Http\Request;
use Validator;
use PDF;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $variety = Outfit::distinct()->get(['type'])->pluck('type');
        $ot = $request->get('outfit_types', '');

        // Sortiravimas ir filtravimas start
        
        $sort = $request->get('sort', '');
        if ($sort == 'a-z')
        {
            $masters = Master::orderBy('name')->get();
        }
        else if ($sort == 'z-a')
        {
            $masters = Master::orderBy('name', 'desc')->get();
        }
        else if ($ot) {
            $otfits = Outfit::where('type', $ot)->get();
            $masters = collect();
            foreach ($otfits as $otfit) {
                $masters->add($otfit->outfitMaster);
            }
        } else {
            $masters = Master::all();
        }
        // dd($masters);
        return view('master.index', [
            'masters' => $masters->unique(),
            'variety' => $variety,
            'variety_now' => $ot
        ]);

        // Sortiravimas ir filtravimas end



        //  Filtravimas start

        // $outfits = Outfit::all();
        // $filter = $request->get('filter', '');
        // if ($filter) {
        //     $masters = Master::where('id', $filter)->get();// db
        // }
        // else {
        //     $masters = Master::all();
        // }

        // return view('master.index', [
        //     'masters' => $masters,
        //     'outfits' => $outfits,
        //     'filter' => $filter ?? 0
        //     ]);
        // Filtravimas end
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
        $validator = Validator::make(
            $request->all(),
            [
                'master_name' => ['required', 'min:3', 'max:64'],
                'master_surname' => ['required', 'min:3', 'max:64'],
            ],
            [
                'master_surname.required' => 'Kokia Jūsų pavardė?',
                'master_surname.min' => 'Per trumpa pavardė',
                // 'master_surname.max' => 'Ar tikrai tokia ilga pavardė?',
                'master_name.required' => 'Koks Jūsų vardas?',
                'master_name.min' => 'Per trumpas vardas',
                // 'master_name.max' => 'Ar tikrai toks ilgas vardas?',
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->route('master.create')->withErrors($validator);
        }

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
        return view('master.show', ['master' => $master]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'master_name' => ['required', 'min:3', 'max:64'],
                'master_surname' => ['required', 'min:3', 'max:64'],
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->route('master.create')->withErrors($validator);
        }

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
        if ($master->masterOutfits->count()) {
            return redirect()->route('master.index')->with('info_message', 'Trinti negalima, nes turi drabužių.');

            // return 'Trinti negalima, nes turi drabužių';
        }

        $master->delete();
        return redirect()->route('master.index')->with('success_message', 'Sekmingai ištrintas.');
    }
    public function pdf(Master $master)
    {
        $pdf = PDF::loadView('master.pdf', ['master' => $master]);
        return $pdf->download('dosje.pdf');
    }
}
