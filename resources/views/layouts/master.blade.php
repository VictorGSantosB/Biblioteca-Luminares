<!DOCTYPE html>
<html lang="pt-br" class="min-h-screen">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rosario:ital,wght@0,300..700;1,300..700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Main Script -->
    <script defer src="{{ asset('dist/js/main.js') }}"></script>
</head>
<body class="min-h-screen bg-[#cccc]">
    <header class="bg-white shadow-md w-[100%]">
        <nav class="flex justify-between items-center w-[92%] mx-auto z-50">
            <div>
                <img class="cursor-pointer" src="{{ asset('img/NAVBARLOGO.png') }}" alt="..." width="80">
            </div>
            <div class="nav-links duration-500 md:static absolute bg-white md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-5">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                    @guest
                        <li><a class="hover:text-gray-500" href="{{ route('dashboard') }}">Inicio</a></li>
                    @endguest
                    <li><a class="hover:text-gray-500" href="{{ route('dashboard') }}">Livros</a></li>
                    <li><a class="hover:text-gray-500" href="#">Favoritos</a></li>
                    <li><a class="hover:text-gray-500" href="#">Profile</a></li>
                    <li><a class="hover:text-gray-500" href="#">Sobre</a></li>
                    @if (Auth::id() === 1)
                        <li><a class="hover:text-gray-500" href="/book">Cadastrar Livro</a></li>
                        <li><a class="hover:text-gray-500" href="{{ route('users') }}">Usuarios</a></li>
                    @endif
                </ul>
            </div>
            <div class="flex items-center gap-6">
                @guest
                    <a href="{{ route('login.form') }}">
                        <button class="bg-black text-white px-5 py-2 rounded-full hover:scale-110 transition-transform duration-300">Login</button>
                    </a>
                @endguest
                @auth
                    <div>
                        <div class="dropdown inline-block relative">
                            <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                                <span class="mr-1">{{ auth()->user()->name }}</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                            </button>
                            <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                                <li>
                                    <form action="{{ route('login.modal') }}" method="get">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                        <input class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap w-[100%]" type="submit" value="Logout">
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth
                <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="bg-white py-4 px-4 text-center">
        <h4 class="text-2xl font-semibold text-blueGray-700">Biblioteca Luminares</h4>
        <p class="text-base text-blueGray-600">Ache os melhores livros!</p>
        <div class="mt-4 flex justify-center">
            <button class="bg-white text-black shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2">
                <i class="fab fa-twitter"></i>
            </button>
            <button class="bg-white text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2">
                <i class="fab fa-facebook-square"></i>
            </button>
            <button class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2">
                <i class="fab fa-dribbble"></i>
            </button>
            <button class="bg-white text-blueGray-800 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2">
                <i class="fab fa-github"></i>
            </button>
        </div>
        <div class="mt-6 text-blueGray-500 text-sm">
            <span class="block">Copyright © <span id="get-current-year">2021</span> Notus JS by <a href="https://www.creative-tim.com?ref=njs-profile" class="hover:text-blueGray-800">Creative Tim</a>.</span>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    {{-- WARNINGS --}}
    @if (session('logout'))
        <script>
            Swal.fire({
                title: "Você tem certeza?",
                text: "{{ Session::get('logout') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim,quero sair"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login.logout') }}";
                }
            });
        </script>
    @endif
    @if (session('delete'))
        <script>
            Swal.fire({
                title: "Você tem certeza?",
                text: "Você tem certeza disso?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim,quero deletar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('book.delete', Session::get('delete')) }}";
                }
            });
        </script>
    @endif
    @if (session('successDelete'))
        <script>
            Swal.fire({
                title: "Sucesso",
                text: "{{ Session::get('successDelete') }}",
                icon: "success"
            })
        </script>
    @endif
    @if (session('successCad'))
        <script>
            Swal.fire({
                title: "Livro cadastrado com sucesso",
                text: "",
                icon: "success"
            });
        </script>
    @endif
    @if (session('successUpdate'))
        <script>
            Swal.fire({
                title: "{{ Session::get('successUpdate') }}",
                text: "",
                icon: "success"
            });
        </script>
    @endif
    {{-- WARNINGS FIM --}}
    <script>
        const navLinks = document.querySelector('.nav-links')
function onToggleMenu(e) {
    e.name = e.name === 'menu' ? 'close' : 'menu'
    navLinks.classList.toggle('top-[12.6%]')
}
    </script>
</body>
</html>
