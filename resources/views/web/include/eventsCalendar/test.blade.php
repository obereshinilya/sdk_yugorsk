
<html>
<head>

</head>
<body>
@foreach($users as $usr)
    <p>{{$usr->name}} {{$usr->id}}</p>
@endforeach
</body>
</html>


