@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <main class="min-h-screen">
        @guest
            <div class="flex-col lg:flex-row items-center flex justify-between items-center px-5 h-[500px] mx-[20px]">
                <div class="w-1/2 mt-10 md:justify-center md:items-center sm:text-center md:text-center sm:mx-auto md:mx-auto">
                    <h2 class="text-4xl lg:text-5xl font-bold text-center lg:text-left">Bem-vindo ao nosso sistema!</h2>
                    <p class="mt-4 text-lg lg:text-3xl text-center lg:text-left">Por favor, faça login para acessar todos os
                        recursos.</p>
                </div>
                <span>
                    <img src="{{ asset('img/LUMINARES.png') }}" alt="">
                </span>
            </div>
        @endguest

        @auth
            <div class="max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8 md:text-center text-center mx-auto">
                @if (!$books->isEmpty())
                    <div
                        class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 flex justify-center items-center">
                        @foreach ($books as $book)
                            <div class="group">
                                <a href="{{ route('book.show', $book->id) }}">
                                    <div
                                        class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                        <img src="/img/books/{{ $book->image }}" alt="Front of men's Basic Tee in black."
                                            class="h-[300px] w-full object-cover object-center lg:h-full lg:w-full z-0">
                                    </div>
                                </a>
                                <div class="mt-4 flex justify-between">
                                    <div class="flex flex-col">
                                        <h3 class="text-sm text-black">
                                            <a href="{{ route('book.show', $book->id) }}">
                                                <span aria-hidden="true" class="absolute"></span>
                                                Nome: {{ Str::limit($book->nome, 12, '...') }}
                                            </a>
                                        </h3>
                                        <h3 class="text-sm ">
                                            <a href="{{ route('book.show', $book->id) }}">
                                                <span aria-hidden="true" class="absolute"></span>
                                                Author: {{ Str::limit($book->author, 10, '...') }}
                                            </a>
                                        </h3>
                                        {{-- <p class="mt-1 text-sm text-gray-500">Autor: {{ $book->author }}</p> --}}
                                    </div>

                                    <div class="flex space-x-4">
                                        @if (Auth::id() == 1)
                                            <form method="GET" action="{{ route('book.edit', $book->id) }}">
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>
                                            </form>
                                            <form method="GET" action="{{ route('book.modal.delete') }}">
                                                <input name="id" type="hidden" value="{{ $book->id }}">
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1>Nao tem nenhum livro cadastrado</h1>
                @endif
           
            </div>
            
            </div>


        @endauth

    </main>
@endsection
