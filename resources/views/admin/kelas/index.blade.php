<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Data Kelas') }}
            </h2>
            <x-button href="{{ route('admin.kelas.create') }}" variant="yellow"
                class="justify-center max-w-xs gap-2">
                <span>Tambah Kelas</span>
            </x-button>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                <table class="table-fixed">
                    <thead>
                      <tr>
                        <th class="border px-6 py-4">No</th>
                        <th class="border px-6 py-4">Pic</th>
                        <th class="border px-6 py-4">Nama Kelas</th>
                        <th class="border px-6 py-4">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($kelas as $key =>$k)
                        <tr class="text-center">
                          <td class="border px-6 py-4">{{$loop->iteration}}</td>
                          <td class="border px-6 py-4">
                            <img src="{{Storage::url($k->icon)}}" alt="" class="rounded-xl object-cover w-[50px] h-[50px]">
                          </td>
                          <td class="border px-6 py-4">{{$k->name}}</td>
                          <td class="border px-6 py-4 flex flex-row items-center gap-x-3">
                            <a href="{{route('admin.kelas.edit', $k->id)}}" class="py-4 px-5 rounded-full text-white bg-indigo-700">Edit</a>
                            <form method="POST" action="{{ route('admin.kelas.destroy',$k->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="py-4 px-5 rounded-full text-white bg-red-700">delete</button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
