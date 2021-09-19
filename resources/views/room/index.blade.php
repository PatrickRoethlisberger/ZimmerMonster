
<x-app-layout>
    <x-app-body>
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
            Zimmer entdecken
        </h1>
        <form method="GET" action="{{ route('room.index') }}">
            <div class="flex">
                <div class="mt-4 w-2/12 mr-2">
                    <x-jet-label for="stars" value="Sterne" />
                    <x-jet-input id="stars" class="block mt-1 w-full" type="text" name="stars"
                        :value="old('stars')"/>
                </div>
                <div class="mt-4 w-2/12 mr-2">
                    <x-jet-label for="name" value="Name" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')"/>
                </div>
                <div class="mt-4 w-2/12 mr-2">
                    <x-jet-label for="price" value="Maximalpreis" />
                    <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price"
                        :value="old('price')"/>
                </div>
                <div class="mt-4 w-2/12 mr-2">
                    <x-jet-label for="availability[from]" value="Von" />
                    <x-date-picker id="availability[from]" name="availability[from]" class="w-full order-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"/>
                </div>
                <div class="mt-4 w-2/12 mr-2">
                    <x-jet-label for="availability[until]" value="Bis" />
                    <x-date-picker id="availability[until]" name="availability[until]" class="w-full order-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"/>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-jet-button>
                        Filtern
                    </x-jet-button>
                </div>
            </div>
        </form>
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
