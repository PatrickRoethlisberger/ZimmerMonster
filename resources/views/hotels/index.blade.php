
<x-app-layout>
    <x-app-body>
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight mt-4">
            Hotels
        </h1>
        @foreach ($hotels as $hotel)
            <x-card>
                <x-slot name="title">
                    {{ $hotel->name }}
                </x-slot>
                <x-slot name="body">
                    <x-stars stars="{{ $hotel->stars }}"/>
                    <p>{{ $hotel->street }}</p>
                    <p>{{ $hotel->city->PLZ }} {{ $hotel->city->city }}</p>
                    <p>{{ $hotel->phone }}</p>
                    <p>Verkehrsverein: {{ $hotel->touristAssociation->name}}</p>

                </x-slot>

                <x-slot name="buttons">
                    <form method="GET" action="{{ route('room.index') }}">
                        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                        <x-jet-button>
                            Zimmer anzeigen
                        </x-jet-button>
                    </form>
                </x-slot>
            </x-card>
        @endforeach
        {{ $hotels->links() }}
    </x-app-body>
</x-app-layout>
