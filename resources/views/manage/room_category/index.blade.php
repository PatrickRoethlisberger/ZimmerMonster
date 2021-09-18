
<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>
        <div class="flex flex-col sm:flex-row items-left justify-between">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight mt-4">
                Zimmer Preisklassen
            </h1>
            <x-link-button href="{{ route('manage.roomCategory.create')}}" class="mt-4">
                Preisklasse erstellen
            </x-link-button>
        </div>

        @if ($room_categories->count())
            <table class="table-auto w-full mt-4">
                <thead>
                <tr>
                    <th class="text-left py-2">Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
            @foreach ($room_categories as $room_category)
                <tr class="border-t border-gray-100">
                    <td class="py-2">{{ $room_category->name }}</td>
                    <td class="flex items-center justify-end py-2">
                        <x-link-button :href="route('manage.roomCategory.edit', [$room_category])">
                            Bearbeiten
                        </x-link-button>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $room_categories->links() }}
            </div>
        @endif

    </x-app-body>
</x-app-layout>
