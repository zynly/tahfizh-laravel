<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-xl">
                <form method="POST" action="{{ route('admin.siswas.update',$siswa) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-2">
                        <x-form.label for="name" :value="__('Name')"/>
                        <x-form.input id="name" name="name" type="text" class="block w-full" required autofocus value="{{$siswa->user->name}}"/>
                        <x-form.error :messages="$errors->get('name')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="avatar" :value="__('Avatar')"/>
                        <img src="{{Storage::url($siswa->user->avatar)}}" alt="" class="rounded-xl object-cover w-[70px] h-[70px]">
                        <x-form.input id="avatar" name="avatar" type="file" class="block w-full" autocomplete="avatar"/>
                        <x-form.error :messages="$errors->get('avatar')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="email" :value="__('Email')"/>
                        <x-form.input id="email" name="email" type="email" class="block w-full" required autofocus value="{{$siswa->user->email}}" />
                        <x-form.error :messages="$errors->get('email')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="password" :value="__('Password')"/>
                        <x-form.input id="password" name="password" type="password" class="block w-full" />
                        <x-form.error :messages="$errors->get('password')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="kelas_id" :value="__('Kelas')"/>
                        <select name="kelas_id" id="kelas_id" class="block w-full">
                            <option value="{{$siswa->kelas->id}}">{{$siswa->kelas->name}}</option>
                            @foreach ($kelas as $k)
                            <option value="{{$k->id}}">{{$k->name}}</option>
                            @endforeach
                        </select>
                        <x-form.error :messages="$errors->get('kelas_id')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="is_active" :value="__('Status Aktif')" />
                        <!-- Select dropdown for Status Aktif -->
                        <select id="is_active" name="is_active" class="block w-full mt-1 rounded-md shadow-sm border-gray-300">
                            <option value="1" {{ $siswa->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $siswa->is_active == 0 ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                        <x-form.error :messages="$errors->get('is_active')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="ustad_id" :value="__('Ustadz')"/>
                        <select name="ustad_id" id="ustad_id" class="block w-full">
                            @foreach($ustads as $ustad)
                            <option value="{{ $ustad->id }}"
                                {{ optional($siswa->murojaah)->ustad_id == $ustad->id ? 'selected' : '' }}>
                                {{ $ustad->user->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-form.error :messages="$errors->get('ustad_id')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-button>{{ __('Update') }}</x-button>
                    </div>
                </form>
            </div>
        </div>

        
    </div>
</x-app-layout>
