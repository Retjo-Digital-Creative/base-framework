<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="flex flex-col min-h-screen">
    <div class="flex justify-center items-center min-h-screen">
        <h1 class="font-bold text-5xl bg-clip-text bg-gradient-to-r from-indigo-500 to-teal-600 text-transparent">
            {{ env('APP_NAME') }}
        </h1>
    </div>
</body>
</html>
