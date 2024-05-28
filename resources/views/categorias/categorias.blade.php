@extends('layouts.master')

@section('title', 'Categorias')

@section('content')
    <main class="min-h-screen flex justify-center p-10">
        <div class="w-full max-w-6xl">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right bg-[#cccc]">
                    <thead class="text-xs text-black uppercase bg-[#cccc]">
                        <tr>
                            <th scope="col" class="px-6 py-3">

                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nome da Categoria
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantidade de Livros
                            </th>
                            @if (Auth::id() === 1)
                                <th scope="col" class="px-6 py-3">
                                    Ações
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $categoriasOrdenadas = $categorias->sortByDesc(function($categoria) {
                                return $categoria->books->count();
                            });
                        @endphp
                        @foreach ($categoriasOrdenadas as $c)
                            <tr class="bg-white border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{ $c->id }}</td>
                                <td class="px-6 py-4">{{ $c->nome }}</td>
                                <td class="px-6 py-4">{{ $c->books->count() }}</td>
                                @if (Auth::id() === 1)
                                    <td class="px-6 py-4">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-pen"></i></button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
