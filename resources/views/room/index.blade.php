
<x-app-layout>
    <x-app-body>
        @foreach ($rooms as $room)
            {{ $room->name }}
        @endforeach

    </x-app-body>
</x-app-layout>
