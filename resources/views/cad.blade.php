<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- <h1>
        {{auth()->user()->id}}
    </h1> --}}
    <form action="{{route('storeTeste')}}" method="post">
        @csrf
        <input type="text" name="nome">
        <input type="text" name="author">
        <input type="text" name="isbn">
        <input type="text" name="user_id" value="{{auth()->user()->id}}">
        <input type="submit" name="submit">
    </form>
</body>
</html>