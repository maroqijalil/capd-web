<x-app-layout title="Dashboard" withMenu="true">
  <div class="container grid  mb-8 px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      Dashboard
    </h2>

    <!-- Cards -->
    <div class="grid gap-6 mb-4 md:grid-cols-2 xl:grid-cols-2">
      <!-- Card -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
          @include('icons.member')
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Jumlah Penggantian
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $users->total() }}
          </p>
        </div>
      </div>
      <!-- Card -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
          @include('icons.liquid')
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Jumlah Jenis Cairan
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ count($liquids) }}
          </p>
        </div>
      </div>
    </div>

    <!-- Charts -->
    {{-- <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      Charts
    </h2>
    <div class="grid gap-6 mb-4 md:grid-cols-2">
      <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
          Revenue
        </h4>
        <canvas id="pie"></canvas>
        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
          <!-- Chart legend -->
          <div class="flex items-center">
            <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
            <span>Shirts</span>
          </div>
          <div class="flex items-center">
            <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
            <span>Shoes</span>
          </div>
          <div class="flex items-center">
            <span class="inline-block w-3 h-3 mr-1 bg-red-600 rounded-full"></span>
            <span>Bags</span>
          </div>
        </div>
      </div>
      <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
          Traffic
        </h4>
        <canvas id="line"></canvas>
        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
          <!-- Chart legend -->
          <div class="flex items-center">
            <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
            <span>Organic</span>
          </div>
          <div class="flex items-center">
            <span class="inline-block w-3 h-3 mr-1 bg-red-600 rounded-full"></span>
            <span>Paid</span>
          </div>
        </div>
      </div>
    </div> --}}

    <div class="bg-gray-300 my-2 mx-auto" style="height: 0.5px; width: 500px;"></div>

    <!-- List -->
    <h2 class="my-6 text-xl font-bold text-gray-700 dark:text-gray-200">
      Pengguna
    </h2>
    <div class="grid gap-6 mb-8 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3">
      @php
        $index = 0;
      @endphp
      @foreach($users as $user)
      @if ($index % 2 == 0)
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 transition-colors duration-150 hover:bg-red-50 cursor-pointer">
        <div class="w-14 h-14 justify-self-start mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
          @if ($user->foto_profil != "")
          <img class="object-cover w-full h-full rounded-full" src="{{ $user->foto_profil }}" alt="" loading="lazy" />
          @else
          <div class="m-3">
            @include('icons.person', ['size' => 8])
          </div>
          @endif
        </div>
        <div class="flex-1 flex flex-col items-stretch">
          <p class="font-semibold text-md">{{ $user->nama }}</p>
          <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ $user->email }}
          </p>
          <p class="text-xs text-gray-600 dark:text-gray-400">
            {{ ($user->no_hp == "") ? "-" : $user->no_hp }}
          </p>
        </div>
        @include('icons.arrow-right')
      </div>
      @else
      <div class="flex items-center p-4 bg-red-50 rounded-lg shadow-xs transition-colors duration-150 hover:bg-white cursor-pointer">
        <div class="w-14 h-14 justify-self-start p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
          @include('icons.person', ['size' => 8])
        </div>
        <div class="flex-1 flex flex-col items-stretch">
          <p class="font-semibold text-md">{{ $user->nama }}</p>
          <p class="text-sm text-gray-600 dark:text-gray-40">
            {{ $user->email }}
          </p>
          <p class="text-xs text-gray-600 dark:text-gray-40">
            {{ ($user->no_hp == "") ? "-" : $user->no_hp }}
          </p>
        </div>
        @include('icons.arrow-right')
      </div>
      @endif
      @php
        $index++;
      @endphp
      @endforeach
    </div>

    {{ $users->links('vendor.pagination.custom-tailwind') }}
  </div>

  {{-- <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <x-jet-welcome />
      </div>
    </div>
  </div> --}}
</x-app-layout>
