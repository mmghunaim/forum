<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Real Time</title>
</head>
<body>
    <div id="app">
        <v-app>
            <toolbar></toolbar>
            <apphome></apphome>
        </v-app>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>