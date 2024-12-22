<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Data ustadz') }}
            </h2>
            <x-button href="{{ route('admin.ustads.create') }}" variant="yellow"
                class="justify-center max-w-xs gap-2">
                <span>Tambah ustadz</span>
            </x-button>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="sm:mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex-col gap-y-5 overflow-x-auto p-10 shadow-sm sm:rounded-lg">

                <form action="{{ route('admin.ustads.search') }}" method="GET">
                    <input type="text" name="search" placeholder="Cari Ustad..." value="{{ request('search') }}" class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg">
                    {{-- <button type="submit">Cari</button> --}}
                    <x-button type="submit">{{ __('Cari') }}</x-button>
                    
                </form>
                <hr class="my-5">
                <table class="table-auto w-full">
                    <thead>
                      <tr>
                        <th class="border px-6 py-4">No</th>
                        <th class="border px-6 py-4">Pic</th>
                        <th class="border px-6 py-4">Nama Ustadz</th>
                        <th class="border px-6 py-4">No. HP</th>
                        <th class="border px-6 py-4">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @forelse ($ustads as $ustad)
                            <tr class="text-center">
                            <td class="border px-6 py-4">{{$loop->iteration}}</td>
                            <td class="border px-6 py-4">
                                <img src="{{Storage::url($ustad->user->avatar)}}" alt="" class="rounded-xl object-cover w-[50px] h-[50px]">
                            </td>
                            <td class="border px-6 py-4">{{$ustad->user->name}}</td>
                            <td class="border px-6 py-4">{{$ustad->phone_number}}</td>
                            <td class="border px-6 py-4 flex flex-row items-center gap-x-3">
                                <a href="{{route('admin.ustads.edit', $ustad->id)}}" class="py-4 px-5 rounded-full text-white bg-indigo-700">Edit</a>
                                <form method="POST" action="{{ route('admin.ustads.destroy',$ustad->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="py-4 px-5 rounded-full text-white bg-red-700">delete</button>
                                </form>
                            </td>
                            </tr>
                        @empty
                            <p>belum ada data</p>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $ustads->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
