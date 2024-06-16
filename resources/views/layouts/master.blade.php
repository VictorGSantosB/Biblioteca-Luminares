<!DOCTYPE html>
<html lang="pt-br" class="min-h-screen">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Stylesheets -->
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rosario:ital,wght@0,300..700;1,300..700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Main Script -->
    <script defer src="{{ asset('dist/js/main.js') }}"></script>
</head>
<body class="min-h-screen bg-[#cccc]">
    <header class="bg-white shadow-md w-[100%]">
        <nav class="flex justify-between items-center w-[92%] mx-auto">
            <div>
                <a href="/">
                    <img class="cursor-pointer" src="{{ asset('img/NAVBARLOGO.png') }}" alt="..." width="80">
                </a>
            </div>
            <div class="nav-links duration-500 md:static absolute bg-white md:min-h-fit min-h-[20vh] left-0 top-[-100%] md:w-auto w-full flex px-5 z-40">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8 my-5">
                    <li><a class="hover:text-gray-500" href="{{ route('dashboard') }}">Inicio</a></li>
                    <li><a class="hover:text-gray-500" href="{{ route('categoria.index') }}">Categorias</a></li>
                    @if (Auth::id() === 1)
                        <li><a class="hover:text-gray-500" href="{{ route('book.create') }}">Cadastrar Livro</a></li>
                    
                    @endif
                    @auth
                    <li>
                        <div>
                            <div class="">
                                <div class="dropdown inline-block relative">
                                    <button id="dropdown-btn" class="bg-inherit text-gray-700 font-semibold rounded inline-flex items-center">
                                        <span class="mr-1">Filtrar</span>
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                                    </button>
                                    <ul id="dropdown-menu" class="dropdown-menu absolute hidden text-gray-700 pt-1 z-50" style="overflow-y: auto; overflow-x:hidden; max-height: 200px;">
                                        @if (count($categorias) > 0)
                                            @foreach ($categorias as $categoria)
                                                <li class="">
                                                    <a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap w-[100%]" href="{{ route('book.categoria', $categoria->id) }}" style="white-space: nowrap; width: 200px;">{{ Str::limit($categoria->nome, 15, '...') }}</a>
                                                </li>
                                            @endforeach
                                        @else
                                                @if (Auth::id() === 1)
                                                <li class="">
                                                    <button onclick="openModal()" class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap w-[100%]" style="white-space: nowrap;">Cadastre novas categorias</button>
                                                </li>
                                                @else
                                                <li class="">
                                                    <button disabled class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap w-[100%]" style="white-space: nowrap;">Não há categorias cadastradas</button>
                                                </li>
                                                @endif
                                         
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>                    
@endauth
</ul>
</div>
<div class="flex items-center gap-6">
    @guest
        <a href="{{ route('login') }}">
            <button
                class="bg-black text-white px-5 py-2 rounded-full hover:scale-110 transition-transform duration-300">Login</button>
        </a>
    @endguest
    @auth
        <div>
            <div class="dropdown inline-block relative z-50">
                <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                    <span class="mr-1">{{ auth()->user()->name }}</span>
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </button>
                <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                    <li>
                        <form action="{{ route('login.modal') }}" method="get">
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <input
                                class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap w-[100%]"
                                type="submit" value="Logout">
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

<footer class="bg-white py-4 px-4 text-center absolute z-40 w-full">
    <h4 class="text-2xl font-semibold text-blueGray-700">Biblioteca Luminares</h4>
    <p class="text-base text-blueGray-600">Ache os melhores livros!</p>
    <div class="mt-4 flex justify-center">
        <button
            class="bg-white text-black shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2">
            <i class="fab fa-twitter"></i>
        </button>
        <button
            class="bg-white text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2">
            <i class="fab fa-facebook-square"></i>
        </button>
        <button
            class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2">
            <i class="fab fa-dribbble"></i>
        </button>
        <button
            class="bg-white text-blueGray-800 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2">
            <i class="fab fa-github"></i>
        </button>
    </div>
    <div class="mt-6 text-blueGray-500 text-sm">
        <span class="block">Copyright © <span id="get-current-year">2021</span> Notus JS by <a
                href="https://www.creative-tim.com?ref=njs-profile" class="hover:text-blueGray-800">Creative
                Tim</a>.</span>
    </div>
</footer>
<script src="{{ asset('jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('parsleyjs/dist/parsley.min.js') }}"></script>
<script src="{{ asset('parsleyjs/dist/i18n/pt-br.js') }}"></script>
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
            confirmButtonText: "Sim,quero sair",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login.logout') }}";
            }
        });
    </script>
@endif


@if (session('deleteCategoria'))
    <script>
        Swal.fire({
            title: "Você tem certeza?",
            text: "Você tem certeza disso?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim,quero deletar",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('categoria.delete', Session::get('deleteCategoria')) }}";
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
            confirmButtonText: "Sim,quero deletar",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('book.delete', Session::get('delete')) }}";
            }
        });
    </script>
@endif
@if (session('admInvalid'))
<script>
    Swal.fire({
        title: "Faill",
        text: "{{ Session::get('admInvalid') }}",
        icon: "warning"
    })
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
@if (session('successCategoria'))
    <script>
        Swal.fire({
            title: "{{ Session::get('successCategoria') }}",
            text: "",
            icon: "success"
        });
    </script>
@endif
{{-- WARNINGS FIM --}}
<div id="categoryModal" class="fixed z-10 inset-0 overflow-y-auto hidden transition-opacity duration-300 ease-out z-50">
    <div class="flex items-center justify-center min-h-screen px-4 text-center">
        <!-- Fundo escuro com transição de opacidade -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
            onclick="closeModal()"></div>

        <!-- Conteúdo do modal -->
        <div
            class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    Cadastrar Nova Categoria
                </h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <!-- Formulário -->
                <form action="{{ route('categoria.store') }}" method="POST" class="w-full max-w-md mx-auto"
                    data-parsley-validate>
                    @csrf
                    <div class="pb-3">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nome">
                            Nome*
                        </label>
                        <input required
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="nome" id="nome" type="text" placeholder="Nome da Categoria">
                            @error('nome')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="flex justify-center pt-4">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Cadastrar Nova Categoria
                        </button>
                    </div>
                </form>
            </div>
            <!-- Botão de Cancelar -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    onclick="closeModal()">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    const navLinks = document.querySelector('.nav-links')

    function onToggleMenu(e) {
        e.name = e.name === 'menu' ? 'close' : 'menu'
        navLinks.classList.toggle('top-[10%]')
    }

    function openModal() {
        document.getElementById('categoryModal').classList.remove('hidden');
    }

    @if ($errors->any())
        document.getElementById('categoryModal').classList.remove('hidden');
    @endif

    function closeModal() {
        document.getElementById('categoryModal').classList.add('hidden');
    }
</script>
</body>

</html>
