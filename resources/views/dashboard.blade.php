<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>Star on Github</span>
            </x-button>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="grid grid-cols-3 gap-4">
            <!-- Kolom 1 -->
            <div class="flex flex-col items-center">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12l9-5-9-5-9 5 9 5z" />
                </svg>
                <!-- Deskripsi -->
                <h3 class="mt-4 text-lg font-semibold">Siswa</h3>
                <p class="text-gray-500">Jumlah Siswa {{$siswas}}</p>
            </div>
    
            <!-- Kolom 2 -->
            <div class="flex flex-col items-center">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12l9-5-9-5-9 5 9 5z" />
                </svg>
                <!-- Deskripsi -->
                <h3 class="mt-4 text-lg font-semibold">Ustadz</h3>
                <p class="text-gray-500">Jumlah Ustadz {{$ustads}}</p>
            </div>
    
            <!-- Kolom 3 -->
            <div class="flex flex-col items-center">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12l9-5-9-5-9 5 9 5z" />
                </svg>
                <!-- Deskripsi -->
                <h3 class="mt-4 text-lg font-semibold">Kolom 3</h3>
                <p class="text-gray-500">Deskripsi Kolom 3</p>
            </div>
        </div>

        <hr class="my-5">
        <h3 class="text-black-950 text-2xl py-4 font-bold">Data Murojaah Terbaru</h3>
        <table class="table-auto w-full">
            <thead>
              <tr>
                <th class="border px-6 py-4">No</th>
                <th class="border px-6 py-4">Nama siswa</th>
                <th class="border px-6 py-4">Kelas</th>
                <th class="border px-6 py-4">Nama Surat</th>
                <th class="border px-6 py-4">Ayat ke</th>
                <th class="border px-6 py-4">Nilai</th>
                <th class="border px-6 py-4">Tanggal</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($historyMurojaahs as $h)
                    <tr class="text-center">
                        <td class="border px-6 py-4">{{$loop->iteration}}</td>
                        <td class="border px-6 py-4">{{$h->murojaah->siswa->user->name}}</td>
                        <td class="border px-6 py-4">{{$h->murojaah->siswa->kelas->name}}</td>
                        <td class="border px-6 py-4">{{$h->surat->name}}</td>
                        <td class="border px-6 py-4">{{$h->ayatke}}</td>
                        <td class="border px-6 py-4">{{$h->nilai}}</td>
                        <td class="border px-6 py-4">{{$h->created_at}}</td>
                    </tr>
                @empty
                    <p>belum ada data</p>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
