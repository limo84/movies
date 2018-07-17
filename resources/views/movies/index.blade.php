@extends('layouts.app')

@section('content')
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h1>Catalog</h1>
            </div>


            {{--PLUS - SIGN--}}
            @if (Auth::user())
                <a href="{{ action('MovieController@create') }}" class="btn btn-dark">
                    <span class="oi oi-plus" aria-hidden="true"></span>
                </a>
            @endif
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered">
            @foreach ($movies as $movie)
                <tr>
                    <td class="align-middle">
                        <a href="{{ action('MovieController@show', $movie) }}">{{ $movie->title . ' ' . $movie->part . ' ' . $movie->subtitle }}</a>
                    </td>

                    <td class="align-middle">
                        published in {{ $movie->publication_year === null ? '?' : $movie->publication_year }}
                    </td>

                    <td class="align-middle">
                        @include("partial.rating", ['rating' => $movie->avgRating(), 'url' => action('MovieController@rate', $movie)])

                        <form action="{{ action('MovieController@rate', $movie) }}" method="post">
                            @csrf
                            {{--<input type="text" name="rating" value="1.5">--}}
                        </form>
                    </td>

                    <td class="align-middle">
                        @if ($movie->regisseur !== null)
                            by {{ $movie->regisseur->forename . ' ' . $movie->regisseur->lastname }}
                        @else
                            N.A.
                        @endif
                    </td>

                    <td class="align-middle">
                        @foreach($movie->genres as $genre)
                            <a href="{{ action('MovieController@index', ['genre' => $genre->name]) }}">{{ $genre->name }}</a>
                            ,
                        @endforeach
                    </td>

                    <td class="align-middle">
                        <img src="images/{{ $movie->title . '.jpg' }}" alt="hmmmmm..." width="50px">
                    </td>

                    @if(Auth::user())
                        <td class="text-center align-middle">
                            <a href="{{ action('MovieController@edit', $movie->id) }}"
                               class="btn btn-primary">Edit</a>
                        </td>

                        <td class="text-center align-middle">
                            {{--DELETE - BUTTON--}}
                            <form method="POST" action="{{ action('MovieController@delete', $movie->id) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-dark" aria-hidden="true"><span
                                            class="oi oi-minus"></span></button>
                                {{--<span class="oi oi-minus"></span>  btn btn-primary--}}
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
@endsection