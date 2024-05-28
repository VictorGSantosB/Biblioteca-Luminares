@extends('layouts.master')

@section('title', 'Categoria: ' . $categoria->nome)

@section('content')
<main class="min-h-screen">
    <div class="mx-5 mt-8">
        <h1 class="text-3xl font-semibold text-center mb-4">Categoria: '{{$categoria->nome}}'</h1>
    </div>
    <div class="max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8 md:text-center text-center mx-auto">
        @if ($books->isEmpty())
            <p class="text-lg text-gray-700">Não há nenhum livro nessa categoria!</p>
        @else
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 flex justify-center items-center">
                @foreach ($books as $book)
                    <div class="group">
                        <a href="{{route('book.show', $book->id)}}">
                            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                <img src="/img/books/{{$book->image}}"
                                    alt="Front of men's Basic Tee in black."
                                    class="h-[300px] w-full object-cover object-center lg:h-full lg:w-full z-0">
                            </div>
                        </a>
                        <div class="mt-4 flex justify-between">
                            <div class="">
                                <h3 class="text-sm text-gray-700">
                                    <a href="{{route('book.show', $book->id)}}">
                                        <span aria-hidden="true" class="absolute"></span>
                                       Nome: {{ $book->nome }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Autor: {{ $book->author }}</p>
                                <h3 class="text-sm text-gray-700">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute"></span>
                                        Fornecido: {{ $book->user->name}}
                                    </a>
                                </h3>
                            </div>
                            
                            <div class="flex space-x-4">
                                @if (Auth::id() == 1)
                                    <form method="GET" action="{{ route('book.edit', $book->id) }}">
                                        <button type="submit" class="text-sm font-medium text-gray-900">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </form>
                                    <form method="GET" action="{{ route('book.modal.delete') }}">
                                        @csrf
                                        <input name="id" type="hidden" value="{{$book->id}}">
                                        <button type="submit" class="text-sm font-medium text-red-600">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    
</main>  
@endsection
