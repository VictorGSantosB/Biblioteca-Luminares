@extends('layouts.master')

@section('title', 'Livro')

@section('content')
    <main class="min-h-screen">
        <div class="mx-auto max-w-2xl px-4 py-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:py-16">

            {{-- Imagem do Livro --}}
            <div class="lg:col-span-1">
                <img src="/img/books/{{ $book->image }}" alt="Livro" class="w-full h-[400px] object-cover object-center rounded-lg">
            </div>

            {{-- Detalhes do Livro --}}
            <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $book->nome }}</h1>
                <h2 class="text-3xl tracking-tight text-gray-900">ISBN: {{ $book->isbn }}</h2>
                <div class="mt-6">
                    <h2 class="text-3xl font-medium text-gray-900">Descrição</h2>
                    <p class="mt-2 text-base text-gray-600">{{ $book->descricao }}</p>
                </div>
                <div class="mt-6">
                    <h2 class="text-3xl font-medium text-gray-900">Categoria</h2>
                    <p class="mt-2 text-base text-gray-600">{{ $book->categoria->nome }}</p>
                </div>
            </div>
        </div>
    </main>
@endsection
