<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{env('APP_NAME')}}</title>
  <style>
    body{ background-color: lightblue;
    text-align: center;
  font-family: Verdana,  sans-serif}
  </style>
</head>
<body>
  <h2>E' stato inviato un messaggio</h2>

  <p>{{$content}}</p>

</body>
</html>