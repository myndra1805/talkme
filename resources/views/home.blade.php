@extends('layouts.app')

@section('content')
    <bread-crumb
        links=""
    ></bread-crumb>
    <v-container fluid>
        <map-app id="{{$id}}"></map-app>
    </v-container>
@endsection

<script>
    function showInfo(item){
        document.querySelector("#modal-info").classList.add("show-info")
        document.querySelector("#modal-info").classList.remove("hide-info")
        document.querySelector("body").style.overflow = "hidden";
    }

    function closeInfo(){
        document.querySelector("#modal-info").classList.remove("show-info")
        document.querySelector("#modal-info").classList.add("hide-info")
    }
</script>

<style>
    #modal-info{
        position: absolute;
        top: 50px;
        left: 0;
        right: 0;
        margin: auto;
        transition: .5s;
    }
    .show-info{
        opacity: 1;
        transition: .5s;
    }
    .hide-info{
        opacity: 0;
        transform: scale(0);
    }
</style>