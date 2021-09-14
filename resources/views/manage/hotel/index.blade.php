<x-app-layout>
    <x-slot name="header">
        </>
    </x-slot>

    <x-app-body>
        <div class="flex items-center justify-between mt-4">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                Hotels
            </h1>
            <x-link-button href="{{ route('hotel.create') }}">
                Hotel erstellen
            </x-link-button>
        </div>

        @if ($hotels->count())
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
                        <x-link-button :href="route('hotel.edit', [$hotel])">
                            Bearbeiten
                        </x-link-button>
                    </x-slot>
                </x-card>
            @endforeach
            <div class="mt-4">
                {{ $hotels->links() }}
            </div>
        @endif
    </x-app-body>
</x-app-layout>
