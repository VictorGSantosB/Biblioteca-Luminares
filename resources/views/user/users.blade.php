@extends('layouts.master')

@section('title', 'Usuarios')

@section('content')
<main class="min-h-screen">
    <div class="container-table h-full flex justify-center items-center py-10">
        <div class="flex flex-col w-full max-w-7xl">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-2">
                    <div class="overflow-hidden">
                        <table
                            class="w-full text-left text-lg font-medium bg-[#cccc] text-surface text-black">
                            <thead
                                class="border-b border-neutral-200 font-bold dark:border-white/10">
                                <tr>
                                    <th scope="col" class="px-10 py-8">#</th>
                                    <th scope="col" class="px-10 py-8">Name</th>
                                    <th scope="col" class="px-10 py-8">email</th>
                                    <th scope="col" class="px-10 py-8">telefone</th>
                                    <th scope="col" class="px-10 py-8">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                                    <td class="whitespace-nowrap px-10 py-8 font-bold">{{$u->id}}</td>
                                    <td class="whitespace-nowrap px-10 py-8">{{$u->name}}</td>
                                    <td class="whitespace-nowrap px-10 py-8">{{$u->email}}</td>
                                    <td class="whitespace-nowrap px-10 py-8">{{$u->telefone}}</td>
                                    <td class="whitespace-nowrap px-10 py-8">
                                        <button>delete</button><button>edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
