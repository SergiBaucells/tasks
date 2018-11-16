@extends('layouts.app')

@section('title')
    Calendari
@endsection
@section('content')
    <h1>CALENDARI</h1>
    <v-date-picker v-model="picker" color="pink" header-color="pink" full-width></v-date-picker>
@endsection