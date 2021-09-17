
<x-app-layout>
    <x-slot name="header">
        </>
    </x-slot>

    <x-app-body>
        <div class="flex items-center justify-between mt-4">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                Schlafplätze
            </h1>
            <x-link-button href="{{ route('manage.bedtype.create') }}">
                Schlafplatz erstellen
            </x-link-button>
        </div>

        @if ($bedtypes->count())
            <table class="table-auto w-full mt-4">
                <thead>
                <tr>
                    <th class="text-left py-2">Name</th>
                    <th class="text-left py-2">Schlafplätze</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
            @foreach ($bedtypes as $bedtype)
                <tr class="border-t border-gray-100">
                    <td class="py-2">{{ $bedtype->name }}</td>
                    <td class="py-2">{{ $bedtype->sleepingspots }}</td>
                    <td class="flex items-center justify-end py-2">
                        <x-link-button :href="route('manage.bedtype.edit', [$bedtype])">
                            Bearbeiten
                        </x-link-button>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $bedtypes->links() }}
            </div>
        @endif

    </x-app-body>
</x-app-layout>
