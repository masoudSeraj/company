<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')

    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>

    <style>
        input:focus {
            --tw-ring-color: inital
        }
    </style>

    {{ Illuminate\Support\Facades\Vite::useHotFile(storage_path('vite.hot'))
        ->useBuildDirectory('build')
        ->withEntryPoints(['resources/js/app.js']) }}

    @inertiaHead

</head>
    <body class="tw-min-h-screen tw-font-sans tw-antialiased tw-leading-none tw-text-gray-700 tw-bg-repeat" style="background-image: url('{{ config('company.storage_path') . '/background.jpg' }}'); background-size: cover">
        @inertia
    </body>
</html>
