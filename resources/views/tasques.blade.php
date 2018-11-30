@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                {{--@if(Auth::user()->can('tasks.manage'))--}}
                {{--<tasques :tasks="{{ $tasks }}" :uri="/api/v1/tasks"></tasques> // Totes les tasques--}}
                {{--@else--}}
                {{--<tasques :tasks="{{ $tasks }}" :uri="/api/v1/users/tasks"></tasques>--}}
                {{--@endif--}}

                {{--@can('tasks.manage')--}}
                {{--<tasques :tasks="{{ $tasks }}" :uri="/api/v1/tasks"></tasques> // Totes les tasques--}}
                {{--@else--}}
                {{--<tasques :tasks="{{ $tasks }}" :uri="/api/v1/users/tasks"></tasques>--}}
                {{--@endif--}}
                <tasques :tasks="{{ $tasks }}" :users="{{ $users }}" uri="{{ $uri }}"></tasques>
            </v-flex>
        </v-layout>
    </v-container>
@endsection