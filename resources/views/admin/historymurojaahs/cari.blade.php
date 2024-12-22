<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Cari Data') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{ route('admin.historymurojaah.search') }}" method="GET" class="space-y-4">
            <div>
                <label for="from_date">Tanggal Mulai:</label>
                <input type="date" name="from_date" id="from_date" class="border px-4 py-2 rounded-lg" value="{{ request('from_date') }}">
            </div>
        
            <div>
                <label for="to_date">Tanggal Akhir:</label>
                <input type="date" name="to_date" id="to_date" class="border px-4 py-2 rounded-lg" value="{{ request('to_date') }}">
            </div>
        
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Cari</button>
        </form>
        
    </div>
</x-app-layout>
