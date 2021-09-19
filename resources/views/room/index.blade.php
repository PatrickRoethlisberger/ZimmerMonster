
<x-app-layout>
    <x-app-body>
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
            Zimmer entdecken
        </h1>
        @foreach ($rooms as $room)
            <x-room-list-item :model="$room">
                <x-slot name="buttons">
                    <x-link-button :href="route('room.show',['room' => $room ])">
                        Jetzt buchen
                    </x-link-button>
                </x-slot>
            </x-room-list-item>
        @endforeach
        <div class="mt-4">
            {!! $rooms->render() !!}
        </div>

    </x-app-body>
</x-app-layout>
