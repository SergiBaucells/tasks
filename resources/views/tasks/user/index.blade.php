@extends('layouts.app')

@section('title')
    Tasques
@endsection

@section('content')
    <tasques :tasks="{{ $tasks }}"></tasques>
@endsection