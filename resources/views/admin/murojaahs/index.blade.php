<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Data Murojaah') }}
            </h2>
            {{-- <x-button href="{{ route('admin.siswas.create') }}" variant="yellow"
                class="justify-center max-w-xs gap-2">
                <span>Tambah siswa</span>
            </x-button> --}}
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="sm:mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex-col gap-y-5 overflow-x-auto p-10 shadow-sm sm:rounded-lg">
{{-- 
                <form action="{{ route('admin.siswas.search') }}" method="GET">
                    <input type="text" name="search" placeholder="Cari siswa..." value="{{ request('search') }}" class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg">
                    <x-button type="submit">{{ __('Cari') }}</x-button>
                </form>
 --}}
                <table class="table-auto w-full">
                    <thead>
                      <tr>
                        <th class="border px-6 py-4">No</th>
                        <th class="border px-6 py-4">Pic</th>
                        <th class="border px-6 py-4">Nama siswa</th>
                        <th class="border px-6 py-4">Kelas</th>
                        <th class="border px-6 py-4">Ustadz</th>
                        <th class="border px-6 py-4">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @forelse ($murojaahs as $m)
                            <tr class="text-center">
                            <td class="border px-6 py-4">{{$loop->iteration}}</td>
                            <td class="border px-6 py-4">
                                <a href="{{ Storage::url($m->siswa->user->avatar) }}" target="_blank">
                                <img src="{{Storage::url($m->siswa->user->avatar)}}" alt="" class="rounded-xl object-cover w-[50px] h-[50px]">
                                </a>
                            </td>
                            <td class="border px-6 py-4">{{$m->siswa->user->name}}</td>
                            <td class="border px-6 py-4">{{$m->siswa->kelas->name}}</td>
                            <td class="border px-6 py-4">{{$m->ustad->user->name}}</td>
                            <td class="border px-6 py-4 flex flex-row items-center gap-x-3">
                                <a href="{{route('admin.murojaahs.show', $m->id)}}" class="py-4 px-5 rounded-full text-white bg-indigo-700">Details</a>
                            </td>
                            </tr>
                        @empty
                            <p>belum ada data</p>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $murojaahs->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
