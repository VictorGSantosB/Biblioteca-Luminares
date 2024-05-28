@extends('layouts.master')

@section('title', 'Usuarios')

@section('content')
<main class="min-h-screen">
    <div class="container-table h-full flex justify-center items-center py-10">
        @if (isset($books) && count($books) > 0)
        <div class="flex flex-col w-full max-w-7xl">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-2">
                    <div class="overflow-hidden">
                        <table class="w-full text-left text-lg font-medium bg-[#cccc] text-surface text-black">
                            <thead class="border-b border-neutral-200 font-bold dark:border-white/10">
                                <tr>
                                    <th scope="col" class="px-10 py-8">#</th>
                                    <th scope="col" class="px-10 py-8">Imagem</th>
                                    <th scope="col" class="px-10 py-8">Nome</th>
                                    <th scope="col" class="px-10 py-8">Autor</th>
                                    <th scope="col" class="px-10 py-8">Ação</th> <!-- Nova coluna para o botão de exclusão -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $f)
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                                    <td class="whitespace-nowrap px-10 py-8 font-bold">{{$f->book->id}}</td>
                                    <td class="whitespace-nowrap px-10 py-8 font-bold w-[70px]">
                                        <img src="/img/books/{{$f->book->image}}" alt="">
                                    </td>
                                    <td class="whitespace-nowrap px-10 py-8">{{$f->book->nome}}</td>
                                    <td class="whitespace-nowrap px-10 py-8">{{$f->book->author}}</td>
                                    <td class="whitespace-nowrap px-10 py-8"> <!-- Coluna para o botão de exclusão -->
                                        <form action="{{ route('book.delete', ['id' => $f->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <i class="fa fa-trash"></i> 
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @else
            <h1 class="text-black font-bold">Você ainda não tem nenhum livro favoritado!</h1>
        @endif

    </div>
</main>
@endsection
