
<x-app-layout>
    <x-app-body>
        @foreach ($rooms as $room)
            <x-room-list-item :model="$room" />
        @endforeach
        <div class="mt-4">
            {!! $rooms->render() !!}
        </div>

    </x-app-body>
</x-app-layout>
