@extends('layouts.app')

@section('content')
    <bread-crumb
        links="{{$breadcrumb}}"
    ></bread-crumb>
    <v-container fluid>
        <message-app user="{{json_encode($data)}}" auth="{{ $id }}" to="{{$to}}"></message-app>
    </v-container>
@endsection
