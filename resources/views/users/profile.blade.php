@extends('layouts.backend')

@section('content')

    <h1>hello {{ auth()->user()->name }}</h1>

@endsection
