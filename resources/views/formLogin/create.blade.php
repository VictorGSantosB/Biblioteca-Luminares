<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar-se</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    <div class="flex items-center justify-center h-min-screen bg-gray-100">
      <div
        class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0"
      >
      @if (Auth::check())
      <div class="flex justify-center items-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Você já está logado!</h1>
            <p class="text-lg mb-8">Você pode acessar sua área restrita através do <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">Dashboard</a>.</p>
            <p class="text-gray-600">Se você deseja sair, <a href="{{ route('login.logout') }}" class="text-red-500 hover:underline">faça logout</a>.</p>
        </div>
    </div>


    @else

        <div class="flex flex-col justify-center p-8 md:p-14">
          <span class="mb-3 text-4xl font-bold">Bem vindo</span>
          <span class="font-light text-gray-400 mb-8">
            Preencha com suas credenciais para se cadastrar
          </span>
          <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="py-4 relative">
                <span class="mb-2 text-md">Nome</span>
                <input
                    type="text"
                    class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500 @error('name') border-red-500 @enderror"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                />
                @error('name')
                <span class="absolute top-full left-0 mt-[-10px] text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="py-4 relative">
                <span class="mb-2 text-md">Email</span>
                <input
                    type="text"
                    class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500 @error('email') border-red-500 @enderror"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                />
                @error('email')
                <span class="absolute top-full left-0 mt-[-10px] text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="py-4 relative">
                <span class="mb-2 text-md">Password</span>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500 @error('password') border-red-500 @enderror"
                />
                @error('password')
                <span class="absolute top-full left-0 mt-[-10px] text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="py-4 relative">
                <span class="mb-2 text-md">Telefone</span>
                <input
                    type="text"
                    name="telefone"
                    id="telefone"
                    class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500 @error('telefone') border-red-500 @enderror"
                    value="{{ old('telefone') }}"
                />
                @error('telefone')
                <span class="absolute top-full left-0 mt-[-10px] text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="py-4 pb-[30px] relative">
                <span class="mb-2 text-md">CPF</span>
                <input
                    type="text"
                    name="cpf"
                    id="cpf"
                    class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500 @error('cpf') border-red-500 @enderror"
                    value="{{ old('cpf') }}"
                />
                @error('cpf')
                <span class="absolute top-full left-0 mt-[-27px] text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="w-full bg-black text-white p-2 rounded-lg mb-6 hover:scale-110 transition-transform duration-300"
            >
                Cadastrar
            </button>
        </form>
          <div class="text-center text-gray-400">
            Já tem um conta?
            <a href="{{route('login.form')}}" class="font-bold text-black">Fazer Login</a>
          </div>
        </div>
        <!-- {/* right side */} -->
        <div class="relative">
          <img
            src="{{ asset('img/NAVBARLOGO.png') }}"
            alt="img"
            class="w-[100%] h-full hidden rounded-r-2xl md:block object-cover"
          />
        </div>
      </div>
      @endif
    </div>
  </body>
</html>