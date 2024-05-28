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
                <form action="{{ route('book.update') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-lg"
                    data-parsley-validate>
                    @csrf
                    @method('PUT')
                    <div class="pb-6">
                        <label class="block text-black text-sm font-bold mb-2" for="old_image">
                            Imagem Antiga
                        </label>
                        <img src="/img/books/{{ $book->image }}" alt="Imagem Antiga" class="block w-64 h-auto mb-3">
                    </div>
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="image">
                            Nova Imagem do Livro*
                        </label>
                        <input  required
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                            name="image" id="image" type="file" accept="image/*">
                        @error('image')
                            <span class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="nome">
                            Nome*
                        </label>
                        <input  required
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white @error('nome') border-red-500 @enderror"
                            name="nome" id="nome" type="text" value="{{ old('nome', $book->nome) }}">
                        @error('nome')
                            <span class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="author">
                            Autor*
                        </label>
                        <input required  name="author"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white @error('author') border-red-500 @enderror"
                            id="author" type="text" value="{{ old('author', $book->author) }}">
                        @error('author')
                            <span class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="isbn">
                            ISBN*
                        </label>
                        <input required  name="isbn"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white @error('isbn') border-red-500 @enderror"
                            id="isbn" type="number" value="{{ old('isbn', $book->isbn) }}">
                        @error('isbn')
                            <span class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="categoria">
                            Categoria*
                        </label>
                        <select required  name="categoria_id" id="categoria"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white @error('categoria_id') border-red-500 @enderror">
                            @foreach ($categorias as $c)
                                @if ($c->id === $book->categoria_id)
                                    <option selected value="{{ $c->id }}">{{ $c->nome }}</option>
                                @else
                                    <option value="{{ $c->id }}">{{ $c->nome }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <span class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="descricao">
                            Descrição*
                        </label>
                        <textarea required  name="descricao"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4  leading-tight focus:outline-none focus:bg-white resize-y @error('descricao') border-red-500 @enderror"
                            id="descricao" placeholder="Descrição do Livro">{{ old('descricao', $book->descricao) }}</textarea>
                        @error('descricao')
                            <p class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <input required type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input required  type="hidden" name="id" value="{{ $book->id }}">
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
