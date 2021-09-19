
<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight mt-4">
            Statistiken
        </h1>
        @foreach ($hotels as $hotel)
                <x-card>
                    <x-slot name="title">
                        {{ $hotel->name }}
                    </x-slot>
                    <x-slot name="body">
                        <p>Reservationen {{ $hotel->reservations->count() }}</p>
                        <p>Zimmer {{ $hotel->rooms->count() }}</p>
                        <p>Mitarbeiter {{ $hotel->team->users->count() }}</p>
                    </x-slot>
                </x-card>
        @endforeach
    </x-app-body>
</x-app-layout>
