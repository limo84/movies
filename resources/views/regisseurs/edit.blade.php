@extends('layouts.app')

@section('content')
    <form method="POST", action="{{ action('RegisseurController@update', $regisseur->id) }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="forename">Forename:</label>
            <input type="text" class="form-control" name="forename"
                   value="{{ $regisseur->forename === null ? "" : $regisseur->forename }}">
        </div>

        <div class="form-group">
            <label for="lastname">Lastname:</label>
            <input type="text" class="form-control" name="lastname"
                   value="{{ $regisseur->lastname === null ? "" : $regisseur->lastname }}">
        </div>

        <div class="form-group">
            <label for="birthyear">Year of Birth</label>
            {{--TYPE = TEXT??--}}
            <input type="text" class="form-control" name="birthyear"
                   value="{{ $regisseur->birthyear === null ? "" : $regisseur->birthyear }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
        </div>

    </form>
@endsection