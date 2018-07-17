@extends('layouts.app')

@section('content')
    <div class="card-header">
        <h1>{{ $regisseur->forename . ' ' . $regisseur->lastname }}</h1>
    </div>
@endsection