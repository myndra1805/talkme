@extends('layouts.app')

@section('content')
    <bread-crumb
        links="{{$breadcrumb}}"
    ></bread-crumb>
    <v-container fluid>
        <chat-app id="{{Auth::user()->id}}"></chat-app>
    </v-container>
@endsection
