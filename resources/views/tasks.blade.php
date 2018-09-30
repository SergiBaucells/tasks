<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Tasques</h1>
@foreach ($tasks as $task)
    <ul>
        <li>{{ $task->name }}
            <form action="/tasks/{{$task->id}}" method="POST">
                @csrf
                {{method_field('PUT')}}
                <button>Completar</button>
            </form>
            <form action="/tasks/{{$task->id}}/edit" method="POST">
                @csrf
                {{method_field('GET')}}
                <button>Modificar</button>
            </form>
            <form action="/tasks/{{$task->id}}" method="POST">
                @csrf
                {{method_field('DELETE')}}
                <button>Eliminar</button>
            </form>
        </li>
    </ul>
@endforeach
<form action="/tasks" method="POST">
    {{--Label--}}
    @csrf
    <input name="name" type="text" placeholder="Nova tasca">
    <input hidden name="token" value="MY_TOKEN" type="text">
    <button>Afegir</button>
</form>

</body>
</html>