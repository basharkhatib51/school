<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>School</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <style>
        a {
            border: 0px;
            padding: 10px;
            background-color: rgb(61, 124, 201)!important;
            color: white!important;
            font-weight: 500;
            /*font-family: JF Flat !important;*/
            border-radius: 10px;
            box-shadow: 0px 0px 14px rgb(61, 124, 201)!important;
            text-decoration: none;
        }
        h2 {
            color: rgb(61, 124, 201);
        }
        body {
            font-family: 'Nunito';
        }
    </style>
</head>
<body class="antialiased">
<h1>{{env('APP_NAME')}}</h1>
<br>
<br>
<a href="{{env('FRONT_APP_URL')}}/signup/{{$email}}/{{$link}}">
    Click to complete your registration
</a>
<br>
<br>
<p>If this is a mistake, just ignore this message and nothing will happen.</p>
</body>
</html>
