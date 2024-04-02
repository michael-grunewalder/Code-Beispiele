@extends('keycloakauth::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('keycloakauth.name') !!}</p>
@endsection
