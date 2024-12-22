<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
{{-- 
    <x-sidebar.dropdown
        title="Buttons"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Text button"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
        <x-sidebar.sublink
            title="Icon button"
            href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')"
        />
        <x-sidebar.sublink
            title="Text with icon"
            href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')"
        />
    </x-sidebar.dropdown>
 --}}
    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
        M E N U
    </div>

    @role('owner')
    <x-sidebar.link title="Kelas" href="{{route('admin.kelas.index')}}" />
    <x-sidebar.link title="Ustad" href="{{route('admin.ustads.index')}}" />
    <x-sidebar.link title="Siswa" href="{{route('admin.siswas.index')}}" />
    <x-sidebar.link title="Murojaah" href="{{route('admin.murojaahs.index')}}" />
    @endrole

    @role('owner|ustad')
    <x-sidebar.link title="Cari Murojaah" href="{{route('admin.historymurojaah.cari')}}" />
    <x-sidebar.link title="History Murojaah" href="{{route('admin.historymurojaah.index')}}" />
    @endrole

</x-perfect-scrollbar>
