@extends('layouts.app')

@section('content')
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h1>Regisseurs</h1>
            </div>


            {{--PLUS - SIGN--}}
            @if (Auth::user())
                <div class="col text-right">
                    <a href="{{ action('RegisseurController@create') }}" class="btn btn-dark">
                        <span class="oi oi-plus" aria-hidden="true"></span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered">
            @foreach ($regisseurs as $regisseur)
                <tr>
                    <td class="align-middle">
                        <a href="{{ action('RegisseurController@show', $regisseur) }}">{{ $regisseur->forename . ' ' . $regisseur->lastname }}</a>
                    </td>

                    <td class="align-middle">
                        born in
                        {{ $regisseur->birthyear == 0 ? "?" : $regisseur->birthyear }}
                    </td>


                    @if(Auth::user())
                        <td class="text-center align-middle">
                            {{--EDIT- BUTTON--}}
                            <a href="{{ action('RegisseurController@edit', $regisseur->id) }}" type="submit" class="btn btn-primary">Edit</a>
                        </td>

                        <td class="text-center align-middle">
                            {{--DELETE - BUTTON--}}
                            <form method="POST" action="{{ action('RegisseurController@delete', $regisseur->id) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
@endsection