<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Planiza')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
    <body class="font-poppins bg-off-white text-slate-navy">
        <div class="flex min-h-screen">
            @include('admin.components.sidebar.sidebar')

            <main id="mainContent" class="flex-1 h-screen overflow-y-auto">
                @yield('content')
                @stack('scripts')
            </main>
        </div>
    </body>
</html>
