
<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>

        <div class="flex flex-col sm:flex-row items-left justify-between">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight mt-4">
                Zimmer von "{{ $hotel->name }}"
            </h1>
            <x-link-button href="{{ route('manage.room.create', [$hotel]) }}" class="mt-4">
                Zimmer erstellen
            </x-link-button>
        </div>

        @foreach ($rooms as $room)
            <x-room-list-item :model="$room">
                <x-slot name="buttons">
                    <x-link-button :href="route('manage.room.edit',['room' => $room , 'hotel' => $room->hotel])">
                        Zimmer bearbeiten
                    </x-link-button>
                </x-slot>
            </x-room-list-item>
        @endforeach
        <div class="mt-4">
            {{ $rooms->links() }}
        </div>

    </x-app-body>
</x-app-layout>
