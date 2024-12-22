<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-xl">
                <form method="POST" action="{{ route('admin.ustads.update',$ustad) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-2">
                        <x-form.label for="name" :value="__('Name')"/>
                        <x-form.input id="name" name="name" type="text" class="block w-full" value="{{$ustad->user->name}}" required autofocus autocomplete="name"/>
                        <x-form.error :messages="$errors->get('name')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="avatar" :value="__('Avatar')"/>
                        <img src="{{Storage::url($ustad->user->avatar)}}" alt="" class="rounded-2xl object-cover w-[50px] h-[50px]">
                        <x-form.input id="avatar" name="avatar" type="file" class="block w-full" autocomplete="avatar"/>
                        <x-form.error :messages="$errors->get('avatar')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="email" :value="__('Email')"/>
                        <x-form.input id="email" name="email" type="email" class="block w-full" value="{{$ustad->user->email}}" required autofocus autocomplete="email"/>
                        <x-form.error :messages="$errors->get('email')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="password" :value="__('Password')"/>
                        <x-form.input id="password" name="password" type="password" class="block w-full"/>
                        <x-form.error :messages="$errors->get('password')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="phone_number" :value="__('No HP')"/>
                        <x-form.input id="phone_number" name="phone_number" type="text" class="block w-full" value="{{$ustad->phone_number}}" required autofocus autocomplete="phone_number"/>
                        <x-form.error :messages="$errors->get('phone_number')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="is_active" :value="__('Status Aktif')" />
                        <!-- Select dropdown for Status Aktif -->
                        <select id="is_active" name="is_active" class="block w-full mt-1 rounded-md shadow-sm border-gray-300">
                            <option value="1" {{ $ustad->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $ustad->is_active == 0 ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                        <x-form.error :messages="$errors->get('is_active')" />
                    </div>
                    <div class="flex items-center gap-4">
                        <x-button>{{ __('Update') }}</x-button>
                    </div>
                </form>
            </div>
        </div>

        
    </div>
</x-app-layout>
