@extends('layouts.app')

@section('title')
    Tasques
@endsection
@section('content')
    <v-card>
        <v-toolbar color="primary" dark>

            <v-toolbar-title>Tasques</v-toolbar-title>

        </v-toolbar>

        <v-list>

            <?php foreach ($tasks as $task) : ?>

            <v-list-tile>

                <v-list-tile-avatar>
                    <img src="https://placeimg.com/100/100/any">
                </v-list-tile-avatar>
                @if($task['completed'])
                    <del>{{ $task['name'] }}</del>

                    <form action="/taskscompleted/{{$task['id']}}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" value="{{ $task['id']  }}">
                        <v-btn type="submit" color="accent">
                            Descompletar
                        </v-btn>
                    </form>

                    <form action="/tasks/{{ $task['id'] }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <v-btn type="submit" color="error">
                            Eliminar
                        </v-btn>
                    </form>

                @else
                    {{ $task['name'] }}

                    <form action="/taskscompleted/{{$task['id']}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $task['id']  }}">
                        <v-btn type="submit" color="accent">
                            Completar
                        </v-btn>
                    </form>

                    <v-btn type="submit" color="secondary" href="/task_edit/{{ $task['id'] }}">
                        Modificar
                    </v-btn>

                    <form action="/tasks/{{ $task['id'] }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <v-btn type="submit" color="error">
                            Eliminar
                        </v-btn>
                    </form>
                @endif
            </v-list-tile>
            <?php endforeach;?>

            <form action="/tasks" method="POST">
                @csrf
                <input style="padding-left: 15px; margin-left: 50%; margin-bottom: 30px; margin-top: 30px; box-shadow: 2px 2px 5px;" name="name" type="text" placeholder="Nova tasca" required>
                <v-btn type="submit" color="success">
                    Afegir
                </v-btn>
            </form>

        </v-list>

    </v-card>
@endsection
