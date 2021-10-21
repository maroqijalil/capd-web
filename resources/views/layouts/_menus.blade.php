@if ($userId)
<div class="py-4 text-gray-500 dark:text-gray-400">
  <div class="ml-6 flex flex-row items-end text-red-600 dark:text-red-300"">
		<img class=" h-8 mr-2" src="{{ asset('img/icon2.png') }}">
    <p class="text-xl self-end m-0" style="font-family: 'Roboto Condensed';">
      Admin <strong class="font-extrabold" style="font-style: normal;">CAPD</strong>
    </p>
  </div>
  <ul class="mt-6">
    <li class="relative px-6 py-3">
      {!! request()->routeIs('user.dashboard') ? '<span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : ''
      !!}
      <a data-turbolinks-action="replace" class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="{{route('user.dashboard', ['id' => $userId])}}">
        @include('icons.home')
        <span class="ml-4">{{ __('Dashboard') }}</span>
      </a>
    </li>
    <li class="relative px-6 py-3">
      {!! request()->routeIs('admin.forms') ? '<span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : ''
      !!}
      <a data-turbolinks-action="replace" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{route('admin.forms')}}">
        @include('icons.person', ['size' => 5])
        <span class="ml-4">Profil</span>
      </a>
    </li>
    <li class="relative px-6 py-3">
      {!! request()->routeIs('admin.forms') ? '<span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : ''
      !!}
      <a data-turbolinks-action="replace" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{route('admin.forms')}}">
        @include('icons.tasks')
        <span class="ml-4">Penggantian</span>
      </a>
    </li>
    <li class="relative px-6 py-3">
      {!! request()->routeIs('admin.cards') ? '<span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : ''
      !!}
      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{route('admin.cards')}}">
        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
          <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
          </path>
        </svg>
        <span class="ml-4">Resep</span>
      </a>
    </li>

    {{-- template --}}
    {{-- <li class="relative px-6 py-3">
      {!! request()->routeIs('admin.charts') ? '<span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : ''
      !!}
      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{route('admin.charts')}}">
    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
      <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
      <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
    </svg>
    <span class="ml-4">Charts</span>
    </a>
    </li>
    <li class="relative px-6 py-3">
      {!! request()->routeIs('admin.buttons') ? '<span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : ''
      !!}
      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{route('admin.buttons')}}">
        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
          <path d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
          </path>
        </svg>
        <span class="ml-4">Buttons</span>
      </a>
    </li>
    <li class="relative px-6 py-3">
      {!! request()->routeIs('admin.modals') ? '<span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : ''
      !!}
      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{route('admin.modals')}}">
        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
          <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
          </path>
        </svg>
        <span class="ml-4">Modals</span>
      </a>
    </li>
    <li class="relative px-6 py-3">
      {!! request()->routeIs('admin.tables') ? '<span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : ''
      !!}
      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{route('admin.tables')}}">
        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
          <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
        </svg>
        <span class="ml-4">Tables</span>
      </a>
    </li>
    <li class="relative px-6 py-3">
      {!! request()->routeIs('admin.calendar') ? '<span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : ''
      !!}
      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{route('admin.calendar')}}">
        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
          <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <span class="ml-4">Calendar</span>
      </a>
    </li> --}}
  </ul>
</div>
@endif
