
<x-app-layout>
    <x-app-body>
        <div class="flex flex-col sm:flex-row items-left justify-between">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight mt-4">
                Reservationen
            </h1>
        </div>

        @foreach ($reservations as $reservation)
            <x-card>
                <x-slot name="title">
                    {{ $reservation->room->hotel->name }}
                </x-slot>
                <x-slot name="body">
                    <p>{{ $reservation->room->name }}</p>
                </x-slot>
                <x-slot name="buttons">
                    @if ($reservation->review == null && $reservation->until < \Carbon\Carbon::now())
                        <x-link-button :href="route('review.create', [$reservation])">
                            Review schreiben
                        </x-link-button>
                    @endif

                </x-slot>
            </x-card>
        @endforeach
        <div class="mt-4">
            {{ $reservations->links() }}
        </div>

    </x-app-body>
</x-app-layout>
