@extends('layouts.main')

@section('container')
<h1>
    hey {{ $current_board["user_id"] }} this your {{ $current_board["name"] }} Board biatch
</h1>
<h3>{{ $current_board["description"] }}</h3>
@endsection