@extends('layouts.app')

@section('content')
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h1>Genres</h1>
            </div>

            <div class="col text-right">
                <a href="{{ action('GenreController@create') }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered">
            @foreach($genres as $genre)
                <tr>
                    <td>
                        <a href="{{ action('MovieController@index', ['genre' => $genre->name]) }}">{{ $genre->name }}</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection