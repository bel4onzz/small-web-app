<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite('resources/sass/app.scss')

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://parsleyjs.org/dist/parsley.min.js"></script>
</head>

<body>

    <main>
        <x-navbar />

        <x-success-flash />

        {{ $slot }}

    </main>

    <div id="page_loader" class="row align-items-center justify-content-center spinner-overlay d-none">
        <div class="col-4 p-2 spinner-grow text-dark mx-2" role="status">
        </div>
        <div class="col-4 p-2 spinner-grow text-primary mx-2" role="status">
        </div>
        <div class="col-4 p-2 spinner-grow text-info mx-2" role="status">
        </div>
    </div>

    <script type="text/javascript">
        $("#datepicker").datepicker({
            format: "yyyy-mm-dd"
        });
    </script>
</body>

</html>
