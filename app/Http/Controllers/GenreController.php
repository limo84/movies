<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all()->sortBy('name');
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $genre = new Genre();
        $genre->name = $request->name;
        $genre->save();
        return redirect(action('GenreController@index'));
    }
}
