@extends('layouts.main')

@section('title', 'Albums')

@section('content')
    <div class="mb-3 text-end">
        <a href="{{ route('albums.create') }}">New Album</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Album</th>
                <th>Artist</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album)
                <tr>
                    <td>
                        {{$album->title}}
                    </td>
                    <td>
                        {{$album->artist}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
