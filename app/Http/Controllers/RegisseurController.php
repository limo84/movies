<?php

namespace App\Http\Controllers;

use App\Regisseur;
use Illuminate\Http\Request;

class RegisseurController extends Controller
{
    public function index()
    {
        $regisseurs = Regisseur::all()->sortBy('forename');
        return view('regisseurs.index', compact('regisseurs'));
    }

    public function show(Regisseur $regisseur)
    {
        return view('regisseurs.regisseur', compact('regisseur'));
    }

    public function create()
    {
        return view('regisseurs.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'forename' => 'required',
            'lastname' => 'required'
        ]);

        $regisseur = Regisseur::where('forename', $request->forename)
            ->where('lastname', $request->lastname)
            ->get()->first();

        if ($regisseur === null) {
            $regisseur = new Regisseur();
            $regisseur->forename = $request->forename;
            $regisseur->lastname = $request->lastname;
            $regisseur->birthyear = $request->birthyear;
            $regisseur->save();
        }
        else {
            $regisseur->birthyear = $request->birthyear;
            $regisseur->save();
        }

        $request->session()->flash('success', 'Regisseur wurde erfolgreich gespeichert.');
        return redirect(action('RegisseurController@index'));
    }

    public function edit(Regisseur $regisseur)
    {
        return view('regisseurs/edit', compact('regisseur'));
    }

    public function update(Regisseur $regisseur, Request $request)
    {
        $regisseur->forename = $request->forename;
        $regisseur->lastname = $request->lastname;
        $regisseur->birthyear = $request->birthyear;
        $regisseur->save();

        return redirect(action('RegisseurController@index'));
    }

    public function delete(Regisseur $regisseur)
    {
        $regisseur->delete();
        return redirect()->back();
    }

    public function search(Request $request)
    {
        // regisseur has more than one name
        $nameArray = explode(' ', $request->term);

        $queryBuilder = Regisseur::where(function ($query) use ($nameArray) {
            $query->where('forename', 'like', $nameArray[0] . "%")
                ->orWhere('lastname', 'like', $nameArray[0] . "%");
        })->limit(10);

        if (count($nameArray) > 1) {
            $queryBuilder = $queryBuilder->where(function ($query) use ($nameArray) {
                $query->where('lastname', 'like', $nameArray[count($nameArray) - 1] . "%")
                    ->orWhere('forename', 'like', "%" . $nameArray[count($nameArray) - 1] . "%");
            });

        }

        $regisseur_names = array();
        foreach ($queryBuilder->get() as $regisseur) {
            $regisseur_names[] = $regisseur->forename . ' ' . $regisseur->lastname;
        }

        return $regisseur_names;
    }
}
