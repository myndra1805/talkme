@extends('layouts.app')

@section('content')
    <bread-crumb
        links="{{$breadcrumb}}"
    ></bread-crumb>
    <v-container>
        <v-row justify="center" class="mt-5">
            <v-col cols="12" md="8">
                <h1 class="text-center">ABOUT US</h1>
                <p class="text-center">TalkMe adalah sebuah website pengirim pesan ke sesesama penggunan lain. Selain dapat mengirimkan pesan ke pengguna lain, website ini juga bisa melacak keberadaan pengguna lain, dan juga dapat memberikan info rute yang dapat dilalui untuk sampai ke lokasi pengguna yang dituju. Pembuatan website ini bertujuan sebagai projek UAS matakuliah SIG T. Website ini dibuat oleh tiga orang mahasiswa jurusan Ilmu Komputer FMIPA UNRI. Yaitu Ari Yuhendra(1803113345), Agustin Siburian(1803113158), Maena Anjheli(1803111226)</p>
            </v-col>
        </v-row>
    </v-container>
@endsection
