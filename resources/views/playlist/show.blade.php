@extends('layouts.main')

@section('title')
    Tracks for {{ $playlist->name }}
@endsection

@section('content')
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Album</th>
                <th>Artist</th>
            </tr>
        </thead>
        <tbody>
            @foreach($playlist->tracks as $track)
                <tr>
                    <td>
                        {{$track->id}}
                    </td>
                    <td>
                        {{$track->name}}
                    </td>
                    <td>
                        {{$track->album->title}}
                    </td>
                    <td>
                        {{$track->album->artist->name}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
