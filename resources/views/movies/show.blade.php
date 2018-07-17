@extends('layouts.app')

@section('content')
    <div class="card-header">
        Store new Movie
    </div>

    <div class="card-body">
        {{ $movie->title }}
    </div>
@endsection