@extends('layouts.app')

@section('content')
    <bread-crumb
        links="{{$breadcrumb}}"
    ></bread-crumb>
    <v-container>
        <profile-app 
            user="{{$user}}"
            csrf='@csrf'
            status="@if(session('status')){{session('status')}}@endif"
            error="@if(session('error')){{session('error')}}@endif"
        ></profile-app>
    </v-container>
@endsection