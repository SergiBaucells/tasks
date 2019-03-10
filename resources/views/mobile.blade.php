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
                <memory></memory>
                <online-state></online-state>
                <network-type-speed></network-type-speed>
                <device-position></device-position>
                <geolocation></geolocation>
            </v-flex>
        </v-layout>
    </v-container>
@endsection