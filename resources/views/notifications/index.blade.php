@extends('layouts.app')

@section('title')
    Notifications
@endsection

@section('content')
    <notifications
            :notifications="{{ $notifications }}"
            :user-notifications="{{ $userNotifications }}"
            :users="{{ $users }}"
    ></notifications>
@endsection
