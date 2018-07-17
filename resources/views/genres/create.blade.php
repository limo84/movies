@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ action('GenreController@store') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Genrename:</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>

@endsection