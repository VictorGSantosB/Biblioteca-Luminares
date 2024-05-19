@extends('layouts.master')

@section('title', 'Cadastro de Livro')

@section('content')
    <main class="min-h-screen flex items-center justify-center">
        @if (Auth::id() === 1)
            <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-lg m-[40px]">
                <div class="title my-[40px] text-5xl text-center">
                    <h4>Livro:</h4>
                    <p>'{{ $book->nome }}'</p>
                </div>
                <form action="{{ route('book.update') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-lg">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="block text-black text-sm font-bold mb-2" for="old_image">
                            Imagem Antiga
                        </label>
                        <img src="/img/books/{{ $book->image }}" alt="Imagem Antiga" class="block w-64 h-auto mb-3">
                    </div>
                    <div class="mb-6">
                        <label class="block text-black text-sm font-bold mb-2" for="image">
                            Nova Imagem do Livro
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            name="image" id="image" type="file" accept="image/*">
                    </div>
                    <div class="mb-6">
                        <label class="block text-black text-sm font-bold mb-2" for="nome">
                            Nome
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            name="nome" id="nome" type="text" value="{{ $book->nome }}">
                    </div>
                    <div class="mb-6">
                        <label class="block text-black text-sm font-bold mb-2" for="author">
                            Autor
                        </label>
                        <input name="author"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="author" type="text" value="{{ $book->author }}">
                    </div>
                    <div class="mb-6">
                        <label class="block text-black text-sm font-bold mb-2" for="isbn">
                            ISBN
                        </label>
                        <input name="isbn"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="isbn" type="number" value="{{ $book->isbn }}">
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="id" value="{{ $book->id }}">
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full px-3">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                                Atualizar Livro
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </main>
@endsection
