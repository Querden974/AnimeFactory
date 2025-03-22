<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>AF | @yield('title', 'Home')</title>
</head>

<body>
    <div id="root" class=" min-h-screen min-w-screen px-24 py-6">
        <x-navbar />
        @yield('content')
    </div>


    @foreach (['success', 'error', 'warning', 'info'] as $type)
        @if (session($type))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        container: "mt-16",
                    }

                });
                Toast.fire({
                    icon: "{{ $type }}", // Dynamique selon le type
                    title: "{{ session($type) }}", // Message dynamique
                });
            </script>
        @endif
    @endforeach
</body>

</html>


