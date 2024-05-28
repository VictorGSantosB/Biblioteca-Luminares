@extends('layouts.master')

@section('title', 'Cadastro de Livro')

@section('content')
    <main class="min-h-screen flex items-center justify-center">
        @if (Auth::id() === 1)
            <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-lg m-[40px]">
                <div class="title my-[40px] text-5xl text-center">
                    <h1>Cadastrar Livros</h1>
                </div>
                <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-lg" data-parsley-validate>
                    @csrf
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="image">
                            Imagem do Livro*
                        </label>
                        <input required
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('image') border-red-500 @enderror"
                            name="image" id="image" type="file" accept="image/*">
                            @error('image')
                            <p class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="nome">
                            Nome*
                        </label>
                        <input required
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('nome') border-red-500 @enderror"
                            name="nome" id="nome" type="text" placeholder="Nome do livro">
                        @error('nome')
                            <p class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="author">
                            Autor*
                        </label>
                        <input required name="author"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('author') border-red-500 @enderror"
                            id="author" type="text" placeholder="Autor do livro">
                        @error('author')
                            <p class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="isbn">
                            ISBN*
                        </label>
                        <input required name="isbn"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('isbn') border-red-500 @enderror"
                            id="isbn" type="number" placeholder="ISBN do livro">
                        @error('isbn')
                            <p class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold mb-2" for="categoria">
                            Categoria*
                        </label>
                        <select required name="categoria_id" id="categoria" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('categoria_id') border-red-500 @enderror">
                            <option selected value="">Categoria</option>
                            @foreach ($categorias as $c)
                            <option value="{{$c->id}}">{{$c->nome}}</option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <p class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="pb-6 relative">
                        <label class="block text-black text-sm font-bold" for="descricao">
                            Descrição*
                        </label>
                        <textarea required name="descricao" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white resize-y @error('descricao') border-red-500 @enderror" id="descricao" placeholder="Descrição do Livro"></textarea>
                        @error('descricao')
                            <p class="absolute top-full left-0 mt-[-20px] text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-2 pt-5">
                        <div class="w-full px-3">
                            <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Cadastrar Livro
                        </button>
                    </div>
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                </form>
            </div>
        @endif
    </main>
@endsection
