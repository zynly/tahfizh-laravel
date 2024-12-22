<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Detail Murojaah') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="sm:mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex-col gap-y-5 overflow-x-auto p-10 shadow-sm sm:rounded-lg">
                <table class="table-auto w-full">
                    <tbody>
                        <td class="border px-6 py-4">
                            <a href="{{ Storage::url($murojaah->siswa->user->avatar) }}" target="_blank">
                            <img src="{{Storage::url($murojaah->siswa->user->avatar)}}" alt="" class="rounded-xl object-cover w-[50px] h-[50px]">
                            </a>
                        </td>
                        <td class="border px-6 py-4">Nama : {{$murojaah->siswa->user->name}}</td>
                        <td class="border px-6 py-4">Kelas : {{$murojaah->siswa->kelas->name}}</td>
                        <td class="border px-6 py-4">Ustadz : {{$murojaah->ustad->user->name}}</td>
                    </tbody>
                </table>
                <hr class="my-5">
                <div class="grid grid-cols-[1fr_2fr] gap-x-8">
                    <div>
                        <form method="POST" action="{{route('admin.historymurojaah.store', $murojaah)}}" class="mt-6 space-y-6">
                            @csrf
                            
                            <div class="space-y-2">
                                <x-form.label for="surat_id" :value="__('Surat')"/>
                                <select name="surat_id" id="surat_id" class="block w-full">
                                    <option value="">Choose Surat</option>
                                    @foreach ($surat as $s)
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                    @endforeach
                                </select>
                                <x-form.error :messages="$errors->get('surat_id')" />
                            </div>
    
                            <div class="space-y-2">
                                <x-form.label for="ayatke" :value="__('Ayat Ke')"/>
                                <x-form.input id="ayatke" name="ayatke" type="number" class="block w-full" required autofocus autocomplete="ayatke"/>
                                <x-form.error :messages="$errors->get('ayatke')" />
                            </div>
    
                            <div class="space-y-2">
                                <x-form.label for="nilai" :value="__('Nilai')"/>
                                <x-form.input id="nilai" name="nilai" type="number" class="block w-full" required autofocus autocomplete="nilai"/>
                                <x-form.error :messages="$errors->get('nilai')" />
                            </div>
    
                            <div class="space-y-2">
                                <x-form.label for="tgl_murojaah" :value="__('tgl_murojaah')"/>
                                <x-form.input id="tgl_murojaah" name="tgl_murojaah" type="date" class="block w-full" required autofocus autocomplete="tgl_murojaah"/>
                                <x-form.error :messages="$errors->get('tgl_murojaah')" />
                            </div>
    
                            <div class="space-y-2">
                                <x-form.label for="keterangan" :value="__('Keterangan')"/>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="block w-full"></textarea>
                                <x-form.error :messages="$errors->get('keterangan')" />
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <x-button>{{ __('Tambah') }}</x-button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <h3 class="text-black-950 text-2xl py-4 font-bold">History Murojaah</h3>
                        <table class="table-auto w-full table-tight">
                            <thead>
                            <tr>
                                <th class="border px-6 py-4">No</th>
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
                </div>
            </div>
        </div>

        
    </div>
</x-app-layout>
