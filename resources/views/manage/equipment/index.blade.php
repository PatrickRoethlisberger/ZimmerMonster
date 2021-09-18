
<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>
        <div class="flex flex-col sm:flex-row items-left justify-between">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight mt-4">
                Einrichtungen
            </h1>
            <x-link-button href="{{ route('manage.equipment.create')}}" class="mt-4">
                Einrichtung erstellen
            </x-link-button>
        </div>

        @if ($equipments->count())
            <table class="table-auto w-full mt-4">
                <thead>
                <tr>
                    <th class="text-left py-2">Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
            @foreach ($equipments as $equipment)
                <tr class="border-t border-gray-100">
                    <td class="py-2">{{ $equipment->name }}</td>
                    <td class="flex items-center justify-end py-2">
                        <x-link-button :href="route('manage.equipment.edit', [$equipment])">
                            Bearbeiten
                        </x-link-button>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $equipments->links() }}
            </div>
        @endif

    </x-app-body>
</x-app-layout>
