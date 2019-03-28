@extends('layouts.chat')

@section('title')
    Xat
@endsection

@section('content')
    <chat :channels="{{ $channels }}"></chat>
@endsection
