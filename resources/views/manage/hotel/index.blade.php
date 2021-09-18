<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>

        <div class="flex flex-col sm:flex-row items-left justify-between">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight mt-4">
                Hotels
            </h1>
            @touristAssociationMember
                <x-link-button href="{{ route('manage.hotel.create') }}" class="mt-4">
                    Hotel erstellen
                </x-link-button>
            @endtouristAssociationMember
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
                        <x-link-button :href="route('manage.hotel.edit', [$hotel])">
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
