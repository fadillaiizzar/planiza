<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Siswa - Planiza')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
    <body class="font-poppins bg-off-white min-h-screen">
        @include('siswa.components.navbar.navbar')

        @yield('content')

        @include('siswa.components.footer.footer')

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const hamburger = document.getElementById("hamburger-dashboard");
                const mobileMenu = document.getElementById("mobileMenuDashboard");

                if (hamburger && mobileMenu) {
                    hamburger.addEventListener("click", function () {
                        mobileMenu.classList.toggle("hidden");
                    });
                }
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        @stack('scripts')
    </body>
</html>
