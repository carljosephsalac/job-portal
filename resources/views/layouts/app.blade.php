<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('student.ico') }}"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Job Portal System</title>
</head>

<body class="dark">
    @yield('content')
</body>

</html>
