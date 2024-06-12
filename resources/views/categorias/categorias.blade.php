@extends('layouts.master')

@section('title', 'Categorias')

@section('content')
    <main class="min-h-screen flex justify-center p-10">
        <div class="w-full max-w-6xl">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right bg-[#cccc]">
                    <thead class="text-xs text-black uppercase bg-[#cccc]">
                        <tr>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">Nome da Categoria</th>
                            <th scope="col" class="px-6 py-3">Quantidade de Livros</th>
                            @if (Auth::id() === 1)
                                <th scope="col" class="px-6 py-3">Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $categoriasOrdenadas = $categorias->sortByDesc(function ($categoria) {
                                return $categoria->books->count();
                            });
                        @endphp

                        @foreach ($categoriasOrdenadas as $index => $c)
                            <tr
                                class="bg-white border-b dark:border-gray-700 @if ($loop->first) bg-[red] @elseif($index === 1) bg-[blue] @endif">
                                <td class="px-6 py-4">{{ $c->id }}</td>
                                <td class="px-6 py-4">{{ $c->nome }}</td>
                                <td class="px-6 py-4">{{ $c->books->count() }}</td>
                                @if (Auth::id() === 1)
                                    <td class="flex gap-5 py-5 px-3">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            onclick="openEditModal({{ $c->id }}, '{{ $c->nome }}')"><i
                                                class="fa-solid fa-pen"></i></button>

                                        <button
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </td>
                                @endif
                            </tr>
                            <div id="editModal"
                                class="fixed z-10 inset-0 overflow-y-auto hidden transition-opacity duration-300 ease-out z-50">
                                <div class="flex items-center justify-center min-h-screen px-4 text-center">
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                        aria-hidden="true" onclick="closeModal()"></div>

                                    <div
                                        class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
                                        <div class="px-4 py-5 sm:px-6">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Editar Categoria <span id="spanEdit"></span>
                                            </h3>
                                        </div>
                                        <div class="px-4 py-5 sm:p-6">
                                            <form action="{{ route('categoria.update') }}" method="POST"
                                                class="w-full max-w-md mx-auto" data-parsley-validate>
                                                @csrf
                                                <div class="pb-3">
                                                    <label class="block text-gray-700 text-sm font-bold mb-2"
                                                        for="nome">
                                                        Nome*
                                                    </label>
                                                    <input required
                                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                        name="nome" id="categoryName" type="text"
                                                        placeholder="Nome da Categoria">
                                                </div>
                                                <input type="hidden" id="categoryId" name="id"
                                                    value="{{ $c->id }}">
                                                <div class="flex justify-center pt-4">
                                                    <button
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                        type="submit">
                                                        Editar Categoria
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <button type="button"
                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                                onclick="closeModalE()">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
            @endforeach
            </tbody>
            </table>
        </div>
        <button onclick="openModal()" class="flutuante round-6">+</button>
    </main>


    <script>
        function openEditModal(categoryId, categoryName) {
            document.getElementById('categoryName').value = categoryName;
            document.getElementById('categoryId').value = categoryId;
            document.getElementById('spanEdit').textContent = categoryName;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModalE() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>

    @if (session('succesCategoriaUpdate'))
        <script>
            Swal.fire({
                title: "{{ Session::get('succesCategoriaUpdate') }}",
                text: "",
                icon: "success"
            });
        </script>
    @endif


    <style>
        .flutuante {
            background-color: #48abe0;
            color: white;
            border: none;
            padding: 5px;
            font-size: 31px;
            height: 80px;
            width: 80px;
            box-shadow: 0 2px 4px darkslategray;
            cursor: pointer;
            transition: all 0.2s ease;
            border-radius: 70%;
            position: fixed;
            bottom: 0px;
            right: 0px;
            margin: 20px;
            text-align: center;
            z-index: 40
        }

        .flutuante:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
