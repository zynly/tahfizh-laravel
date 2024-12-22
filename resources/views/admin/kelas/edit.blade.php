<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-xl">
                <form method="POST" action="{{ route('admin.kelas.update',$kelas) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <x-form.label for="name" :value="__('Name')"/>
                        <x-form.input id="name" name="name" type="text" class="block w-full" value="{{$kelas->name}}" required autofocus autocomplete="name"/>
                        <x-form.error :messages="$errors->get('name')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="icon" :value="__('icon')"/>
                        <img src="{{Storage::url($kelas->icon)}}" alt="" class="rounded-2xl object-cover w-[50px] h-[50px]">
                        <x-form.input id="icon" name="icon" type="file" class="block w-full" autocomplete="icon"/>
                        <x-form.error :messages="$errors->get('icon')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-button>{{ __('Update') }}</x-button>
                    </div>
                </form>
            </div>
        </div>

        
    </div>
</x-app-layout>
