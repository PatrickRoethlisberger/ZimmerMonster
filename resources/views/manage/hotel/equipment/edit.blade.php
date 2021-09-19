<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                Hotel "{{ $hotel->name }}" Equipment bearbeiten
            </h1>

            <x-jet-validation-errors class="mb-4" />

            <livewire:forms.hotel-equipment :hotel="$hotel"/>
    </x-app-body>

</x-app-layout>
