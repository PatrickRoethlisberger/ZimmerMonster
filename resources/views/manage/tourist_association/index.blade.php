
<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>
        <div class="flex flex-col sm:flex-row items-left justify-between">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight mt-4">
                Verkehrsvereine
            </h1>
            @adminMember
                <x-link-button href="{{ route('manage.touristAssociation.create')}}" class="mt-4">
                    Verkehrsverein erstellen
                </x-link-button>
            @endadminMember
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
