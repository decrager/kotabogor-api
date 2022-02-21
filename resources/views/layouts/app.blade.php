<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>API Pemerintah Kota Bogor</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/styles/atom-one-dark.min.css" integrity="sha512-Jk4AqjWsdSzSWCSuQTfYRIF84Rq/eV0G2+tu07byYwHcbTGfdmLrHjUSwvzp5HvbiqK4ibmNwdcG49Y5RGYPTg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/styles/atom-one-light.min.css"
        integrity="sha512-o5v54Kh5PH0dgnf9ei0L+vMRsbm5fvIvnR/XkrZZjN4mqdaeH7PW66tumBoQVIaKNVrLCZiBEfHzRY4JJSMK/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/copy.js') }}" defer></script>

    <style>
        .contacts {
            background-color: #fff;
            padding: 15px;
            max-width: 200px;
            margin: 30px auto;
        }

        .icons {
            width: 16px;
            height: 16px;
            padding: 0;
            margin: 0;
            vertical-align: middle;
        }

        code {
            margin-left: -200px;
            margin-top: -40px;
            margin-bottom: -45px !important;
        }

        table {
            border-collapse: separate;
            border-spacing: 10px;
        }

    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/highlight.min.js"
        integrity="sha512-IaaKO80nPNs5j+VLxd42eK/7sYuXQmr+fyywCNA0e+C6gtQnuCXNtORe9xR4LqGPz5U9VpH+ff41wKs/ZmC3iA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        hljs.highlightAll();
    </script>
</body>

</html>
