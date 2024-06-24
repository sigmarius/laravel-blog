@extends('layouts.app')

@section('title', 'Welcome Page')

@section('content')
    @include('shared.header', ['title' => 'Welcome Page'])

    <div class="container mx-auto">
        <h1>Welcome Page</h1>
    </div>
@endsection
