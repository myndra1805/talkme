@extends('layouts.app')

@section('content')
    <bread-crumb
        links="{{$breadcrumb}}"
    ></bread-crumb>
    <v-container fluid>
        <distance-app id="{{Auth::user()->id}}"></distance-app>
    </v-container>
@endsection
