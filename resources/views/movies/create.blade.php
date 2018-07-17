@extends('layouts.app')

@section('content')
    <div class="card-header">
        Store new Movie
    </div>

    <div class="card-body">
        <form method="POST" action="{{ action('MovieController@store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control autocomplete-field" id="movie-title" name="title" required
                       data-url="{{ action('MovieController@search') }}" data-autofill-url="{{ action('MovieController@detailsByTitle', "") }}">
            </div>

            <div class="form-group">
                <label for="part">Part:</label>
                <input type="text" class="form-control" id="part" name="part">
            </div>

            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle">
            </div>

            <div class="form-group">
                <label for="publication_year">Publication Year</label>
                <input type="text" class="form-control" id="publication_year" name="publication_year">
            </div>

            <div class="form-group">
                <label for="genres">Genres (dividided by commas)</label>
                <input type="text" class="form-control" id="genres" name="genres">
            </div>



            <div class="form-group">
                <label for="regisseur">Regisseur</label>
                <input type="text" class="form-control autocomplete-field" id="regisseur" name="regisseur" required
                       data-url="{{ action('RegisseurController@search') }}">
            </div>

            <div>
                <input name="datei" type="file" size="50" accept="text/*"> </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>
        </form>
    </div>


@endsection