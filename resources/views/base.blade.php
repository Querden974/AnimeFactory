<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>AF | @yield('title', 'Home')</title>
</head>

<body>
    <div id="root" class=" min-h-screen min-w-screen px-24 py-6">
        <x-navbar />
        @yield('content')


    </div>
</body>

</html>
