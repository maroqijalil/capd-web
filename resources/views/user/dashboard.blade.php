<x-app-layout title="Dashboard" withMenu="true" userId="{{ $user_id }}">
  <div class="container grid  mb-8 px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      Dashboard
    </h2>

    <!-- Cards -->
    <div class="grid gap-6 mb-4 md:grid-cols-2 xl:grid-cols-2">
      <!-- Card -->
      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
          @include('icons.tasks')
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            Jumlah Penggantian
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ count($replacements) }}
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
            Penggantian Hari ini
          </p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ count($todays_replacement) }}
          </p>
        </div>
      </div>
    </div>

    <!-- Charts -->
    <h2 class="my-6 text-xl font-bold text-gray-700 dark:text-gray-200">
      Ringkasan Data (7 hari terakhir)
    </h2>
    <div class="grid gap-6 mb-4 md:grid-cols-2">
      <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
          Cairan
        </h4>
        <canvas id="pie-user"></canvas>
        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
          @php
            $index = 0;
          @endphp
          @foreach ($chart_datas['pie']['label'] as $label)
          <div class="flex items-center">
            <span class="inline-block w-3 h-3 mr-1 rounded-full" style="background: {{ $chart_datas['pie']['color'][$index] }};"></span>
            <span>{{ $label }}</span>
          </div>
          @php
            $index++;
          @endphp
          @endforeach
        </div>
      </div>
      <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
          Penggantian
        </h4>
        <canvas id="line-user"></canvas>
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
    </div>

    <div class="bg-gray-300 my-2 mx-auto" style="height: 0.5px; width: 500px;"></div>

    <!-- List -->
    <h2 class="my-6 text-xl font-bold text-gray-700 dark:text-gray-200">
      Penggantian
    </h2>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
              <th class="px-4 py-3">Cairan</th>
              <th class="px-4 py-3">Tanggal</th>
              <th class="px-4 py-3">Waktu Masuk</th>
              <th class="px-4 py-3">Waktu Keluar</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            @foreach($replacements as $replacement)
            <tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                  <div>
                    <p class="font-semibold">{{ $replacement->nama_cairan }}</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                      {{ $replacement->konsentrasi }}
                    </p>
                  </div>
                </div>
              </td>
              <td class="px-4 py-3 text-sm">
                @php
                  $tanggal = date('d-m-Y', $replacement->waktu_masuk_stamp);
                @endphp
                {{ $tanggal }}
              </td>
              <td class="px-4 py-3 text-sm">
                @php
                  $waktu_masuk = date('H:i:s', $replacement->waktu_masuk_stamp);
                @endphp
                {{ $waktu_masuk }}
              </td>
              <td class="px-4 py-3 text-sm">
                @php
                  $waktu_keluar = date('H:i:s', $replacement->waktu_keluar_stamp);
                @endphp
                {{ $waktu_keluar }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- {{ $users->links('vendor.pagination.custom-tailwind') }} --}}
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>
  <script>
    var datas = {!! json_encode($chart_datas['pie']['data']) !!}
    var labels = {!! json_encode($chart_datas['pie']['label']) !!}
    var colors = {!! json_encode($chart_datas['pie']['color']) !!}
    
    const pieUserConfig = {
      type: 'doughnut',
      data: {
        datasets: [
          {
            data: datas,
            backgroundColor: colors,
            label: 'Dataset 1',
          },
        ],
        labels: labels,
      },
      options: {
        responsive: true,
        cutoutPercentage: 80,
        legend: {
          display: false,
        },
      },
    }

    const pieUserCtx = document.getElementById('pie-user')
    window.myPie = new Chart(pieUserCtx, pieUserConfig)

    var labels2 = {!! json_encode($chart_datas['line']['label']) !!}
    var datas1 = {!! json_encode($chart_datas['line']['data1']) !!}
    var datas2 = {!! json_encode($chart_datas['line']['data2']) !!}

    const lineUserConfig = {
      type: 'line',
      data: {
        labels: labels2,
        datasets: [
          {
            label: 'Volume Masuk',
            backgroundColor: '#0694a2',
            borderColor: '#0694a2',
            data: datas1,
            fill: false,
          },
          {
            label: 'Volume Keluar',
            fill: false,
            backgroundColor: '#7e3af2',
            borderColor: '#7e3af2',
            data: datas2,
          },
        ],
      },
      options: {
        responsive: true,
        legend: {
          display: false,
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true,
        },
        scales: {
          x: {
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Tanggal',
            },
          },
          y: {
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Volume',
            },
          },
        },
      },
    }

    const lineUserCtx = document.getElementById('line-user')
    window.myLine = new Chart(lineUserCtx, lineUserConfig)
  </script>
</x-app-layout>
