<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  @dd(auth()->user()->role)
  @if (auth()->user()->role ==='pelatih')
  <h1>halalman pelatih</h1>
  @elseif(auth()->user()->role ==='admin')
  <h1>halalman dashboard</h1>
  @endif
</body>

</html>