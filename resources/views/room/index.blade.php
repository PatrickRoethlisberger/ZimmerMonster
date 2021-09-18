
<x-app-layout>
    <x-app-body>
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight mt-4">
            Zimmer entdecken
        </h1>

        @foreach ($rooms as $room)
            $room->name
        @endforeach

    </x-app-body>
</x-app-layout>
