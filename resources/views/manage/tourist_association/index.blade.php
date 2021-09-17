
<x-app-layout>
    <x-slot name="header">
        </>
    </x-slot>

    <x-app-body>
        <div class="flex items-center justify-between mt-4">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                Verkehrsvereine
            </h1>
            <x-link-button href="{{ route('manage.touristAssociation.create') }}">
                Verkehrsverein erstellen
            </x-link-button>
        </div>

        @if ($touristAssociations->count())
            @foreach ($touristAssociations as $touristAssociation)
                <x-card>
                    <x-slot name="title">
                        {{ $touristAssociation->name }}
                    </x-slot>
                    <x-slot name="body">
                        <p>{{ $touristAssociation->street }}</p>
                        <p>{{ $touristAssociation->city->PLZ }} {{ $touristAssociation->city->city }}</p>
                    </x-slot>
                    <x-slot name="buttons">
                        <x-link-button :href="route('manage.touristAssociation.edit', [$touristAssociation])">
                            Bearbeiten
                        </x-link-button>
                    </x-slot>
                </x-card>
            @endforeach
            <div class="mt-4">
                {{ $touristAssociations->links() }}
            </div>
        @endif

    </x-app-body>
</x-app-layout>
