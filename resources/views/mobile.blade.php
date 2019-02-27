@extends('layouts.app')

@section('title')
    Mobile
@endsection

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <vibrate></vibrate>
                <battery-status></battery-status>
            </v-flex>
        </v-layout>
    </v-container>
@endsection