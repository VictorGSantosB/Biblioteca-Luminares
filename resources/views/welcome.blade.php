@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<main class="bg-[#cccc] min-h-screen">
    @guest
    <div class="container mx-[65px] flex flex-col lg:flex-row justify-center items-center">
        <div class="w-full lg:w-1/2">
            <h2 class="text-5xl lg:text-7xl font-bold text-center lg:text-left sm:mt-5">Bem-vindo ao nosso sistema!</h2>
            <p class="mt-4 text-3xl lg:text-5xl text-center lg:text-left">Por favor, faça login para acessar todos os recursos.</p>
        </div>
        <div class="w-full lg:w-1/2 mt-8 lg:mt-0">
            <img src="{{ asset('img/LUMINARES.png') }}" alt="Imagem de boas-vindas" class="mx-auto lg:ml-auto" width="600">
        </div>
    </div>
    @endguest

    @auth

           <!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->

    <div class="mx-10 max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">

        <div class="mt-6 mx-auto grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 flex justify-center">
        @foreach ($books as $i)
        <div class="group relative">
          <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
            <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h3 class="text-sm text-gray-700">
                <a href="#">
                  <span aria-hidden="true" class="absolute inset-0"></span>
                  {{$i->nome}}
                </a>
              </h3>
              <p class="mt-1 text-sm text-gray-500">{{$i->author}}</p>
            </div>
            <p class="text-sm font-medium text-gray-900">{{$i->isbn}}</p>
          </div>
        </div>
        @endforeach


      </div>
    </div>
  </div>



    @endauth
</main>

@endsection