<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>

        <div class="flex flex-col sm:flex-row items-left justify-between">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight mt-4">
                Reservationen im Hotel "{{ $hotel->name }}"
            </h1>
        </div>

        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Aktuelle Reservation
        </h2>
        @empty($currentReservations)
            <p>
                Keine aktuellen Reservationen gefunden.
            </p>
        @else
            @foreach ($currentReservations as $reservation)
                <x-card>
                    <x-slot name="body">
                        <div class="flex items-center justify-start">
                            <h3 class="text-xl pr-6">
                                {{ $reservation->user->name }}
                            </h3>
                        </div>
                        <p class="mt-4">
                            Vom: {{  \Carbon\Carbon::parse($reservation->from)->format('d.m.Y') }}
                        </p>
                        <p>
                        Bis: {{ \Carbon\Carbon::parse($reservation->until)->format('d.m.Y') }}
                        </p>

                        <p class="mt-2">
                            Zimmer: {{ $reservation->room->name }}
                        </p>

                        @isset($reservation->comment)
                            <p class="mt-4">
                                Spezialwunsch: {{ $reservation->comment }}
                            </p>
                        @endisset
                    </x-slot>
                </x-card>
            @endforeach
        @endempty

        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Aufkommende Reservation
        </h2>
        @empty($upcommingReservations)
            <p>
                Keine aufkommenden Reservationen gefunden.
            </p>
        @else
            @foreach ($upcommingReservations as $reservation)
                <x-card>
                    <x-slot name="body">
                        <div class="flex items-center justify-start">
                            <h3 class="text-xl pr-6">
                                {{ $reservation->user->name }}
                            </h3>
                        </div>
                        <p class="mt-4">
                            Vom: {{  \Carbon\Carbon::parse($reservation->from)->format('d.m.Y') }}
                        </p>
                        <p>
                        Bis: {{ \Carbon\Carbon::parse($reservation->until)->format('d.m.Y') }}
                        </p>

                        <p class="mt-2">
                            Zimmer: {{ $reservation->room->name }}
                        </p>
                    </x-slot>
                </x-card>
            @endforeach
        @endempty

    </x-app-body>
</x-app-layout>
