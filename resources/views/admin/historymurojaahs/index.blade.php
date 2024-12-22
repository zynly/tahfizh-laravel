<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Cari Data') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        
        <table class="table-auto w-full table-tight">
            <thead>
            <tr>
                <th class="border px-6 py-4">No</th>
                <th class="border px-6 py-4">Siswa</th>
                <th class="border px-6 py-4">Surat</th>
                <th class="border px-6 py-4">Ayat Ke</th>
                <th class="border px-6 py-4">Tgl Murojaah</th>
                <th class="border px-6 py-4">Nilai</th>
            </tr>
            </thead>
            <tbody>
                
                @forelse ($historynya as $h)
                    <tr class="text-center">
                        <td class="border px-6 py-4">{{$loop->iteration}}</td>
                        <td class="border px-6 py-4">{{$h->siswa->user->name}}</td>
                        <td class="border px-6 py-4">{{$h->surat->name}}</td>
                        <td class="border px-6 py-4">{{$h->ayatke}}</td>
                        <td class="border px-6 py-4">{{$h->tgl_murojaah}}</td>
                        <td class="border px-6 py-4">{{$h->nilai}}</td>
                    </tr>
                @empty
                    <p>belum ada data</p>
                @endforelse
            </tbody>
        </table>
        
    </div>
</x-app-layout>
