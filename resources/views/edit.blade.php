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
<div class="container">
    <h1>Actualitzar tasca</h1><br/>
    <form method="post" action="{{action('TasksController@update', $id)}}">
        @csrf
        {{method_field('PUT')}}
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{$task->name}}">
        <button>Actualitzar</button>
    </form>
</div>
</body>
</html>