<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Cari Data') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @if($historyMurojaahs->isNotEmpty())
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="border px-6 py-4">No</th>
                        <th class="border px-6 py-4">Siswa</th>
                        <th class="border px-6 py-4">Surat</th>
                        <th class="border px-6 py-4">Ayat Ke</th>
                        <th class="border px-6 py-4">Tgl Murojaah</th>
                        <th class="border px-6 py-4">Nilai</th>
                        <th class="border px-6 py-4">Ustadz</th>
                        <th class="border px-6 py-4">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historyMurojaahs as $history)
                        <tr>
                            <td class="border px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="border px-6 py-4">{{ $history->siswa->user->name}}</td>
                            <td class="border px-6 py-4">{{ $history->surat->name }}</td>
                            <td class="border px-6 py-4">{{ $history->ayatke }}</td>
                            <td class="border px-6 py-4">{{ $history->tgl_murojaah }}</td>
                            <td class="border px-6 py-4">{{ $history->nilai }}</td>
                            <td class="border px-6 py-4">{{ $history->ustad->user->name}}</td>
                            <td class="border px-6 py-4">{{ $history->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>Tidak ada data ditemukan.</p>
            @endif

        
    </div>
</x-app-layout>
