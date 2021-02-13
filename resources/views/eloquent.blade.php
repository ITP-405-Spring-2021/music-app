@extends('layouts.main')

@section('title', 'Eloquent Playground')

@section('content')

{{-- EAGER LOADING BELONGS TO RELATIONSHIPS --}}
@foreach ($tracks as $track)
    <div>
        {{ $track->name }}
        {{ $track->genre->name }}
        {{ $track->album->title }}
    </div>
@endforeach

@endsection
