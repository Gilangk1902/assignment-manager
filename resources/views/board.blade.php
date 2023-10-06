@extends('layouts.main')

@section('container')
<h1>
    hey {{ $board->user->name}} this your {{ $board->title }} Board biatch
</h1>
<h3>{{ $board->title }}</h3>
@endsection