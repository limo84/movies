@extends('layouts.app')

@section('content')
    <div class="card-header">
        Update Movie
    </div>

    <div class="card-body">
        <form method="POST" action="{{ action('MovieController@update', $movie->id) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ $movie->title }}" required>
            </div>

            <div class="form-group">
                <label for="part">Part:</label>
                <input type="text" class="form-control" id="part" name="part"
                    value="{{ $movie->part === null ? "" : $movie->part }}">
            </div>

            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle"
                       value="{{ $movie->subtitle === null ? "" : $movie->subtitle }}">
            </div>

            <div class="form-group">
                <label for="publication_year">Publication Year</label>
                <input type="text" class="form-control" id="publication_year" name="publication_year"
                       value="{{ $movie->publication_year === null ? "" : $movie->publication_year }}">
            </div>

            <div class="form-group">
                <label for="regisseur">Regisseur</label>
                <input type="text" class="form-control autocomplete-field" id="regisseur" name="regisseur" required
                       data-url="{{ action('RegisseurController@search') }}"
                       value="{{ $movie->regisseur === null ? "" : $movie->regisseur->forename . ' ' . $movie->regisseur->lastname }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>
        </form>
    </div>


@endsection