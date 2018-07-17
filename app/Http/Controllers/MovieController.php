<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Movie;
use App\Rating;
use App\Regisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = $request->genre
            ? Genre::where('name', $request->genre)->first()->movies
            : Movie::all();

        $movies = $movies->sortBy('part')->sortBy('title');

        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function movie()
    {
        return view('movies.index');
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request, Movie $movie = null)
    {
        $this->validate(request(), [
            'title' => 'required',
            'regisseur' => 'required'
        ]);

        if (Auth::user()) {

            $nameArray = explode(' ', $request->regisseur);
            $forename = implode(' ', array_slice($nameArray, 0, -1));
            $lastname = $nameArray[count($nameArray) - 1];

            $regisseur = Regisseur::where('forename', $forename)
                ->where('lastname', $lastname)
                ->get()->first();

            if ($regisseur === null) {
                $request->session()->flash('info', 'Regisseur wurde neu angelegt.');
                $regisseur = new Regisseur;
                $regisseur->forename = $forename;
                $regisseur->lastname = $lastname;
                $regisseur->save();
            }


            if ($movie === null) {
                if (Movie::where('title', $request->title)->where('part', $request->part)->exists()) {
                    $request->session()->flash('error', 'Dieser Film existiert bereits.');
                    return redirect()->back();
                }
                $movie = new Movie();
            }

            $movie->title = $request->title;
            $movie->part = $request->part;
            $movie->subtitle = $request->subtitle;
            $movie->regisseur_id = $regisseur->id;
            $movie->publication_year = $request->publication_year;
            $movie->save();

//            $request->datei->storeAs('images', $movie->title . '.jpg');
            $request->datei->move(public_path(). '/images', $movie->title . '.jpg');

            $request_genres = explode(',', $request->genres);
            $request_genres = array_map(function ($item) {
                return trim($item);
            }, $request_genres);

            foreach ($request_genres as $request_genre) {

                $genre = Genre::where('name', $request_genre)->first();

                if ($genre === null) {
                    $genre = new Genre();
                    $genre->name = $request_genre;
                    $genre->save();
                }

                $movie->genres()->attach($genre);
            }
        }

        $request->session()->flash('success', 'Film wurde erfolgreich gespeichert.');
        return redirect(action('MovieController@index'));
    }

    public function delete(Movie $movie)
    {
        $movie->delete();
        return redirect()->back();
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Movie $movie, Request $request)
    {
        return $this->store($request, $movie);
    }

    public function rate(Movie $movie, Request $request)
    {
        $rating = Rating::where('user_id', Auth::user()->id)->where('movie_id', $movie->id)->first();

        if ($rating == null) {

            $rating = new Rating;
            $rating->user_id = Auth::id();
            $rating->movie_id = $movie->id;
        }

        $rating->stars = $request->rating;
        $rating->save();

        return $movie->avgRating();
    }

    public function search(Request $request)
    {
        $uri = 'http://www.omdbapi.com/?apikey=f6eba24b&s=' . urlencode($request->term);
        $response = \Httpful\Request::get($uri)->send();
        $movieTitles = array();

        foreach ($response->body->Search as $movieDataset) {
            $movieTitles[] = $movieDataset->Title;
        }

        return $movieTitles;
    }

    public function detailsByTitle(string $title) {
        $uri = 'http://www.omdbapi.com/?apikey=f6eba24b&t=' . urlencode($title);
        $response = \Httpful\Request::get($uri)->send()->body;

        return ["subtitle" => "", "part" => "", "genres" => $response->Genre,
                "publication_year" => $response->Year, "regisseur" => $response->Director];
    }
}
