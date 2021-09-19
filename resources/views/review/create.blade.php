<x-app-layout>
    <x-app-body>
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                Review erstellen
            </h1>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('review.store', [$reservation]) }}">
                @csrf

                <div class="mt-4">
                    <x-jet-label for="stars" value="Sterne" />
                    <x-jet-input id="stars" class="block mt-1 w-full" type="text" name="stars"
                        :value="old('stars')" required autofocus />
                    <x-jet-label for="description" value="Kommentar" />
                    <x-jet-input id="description" class="block mt-1 w-full" type="description" name="description"
                        :value="old('description')" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-jet-button>
                        Erstellen
                    </x-jet-button>
                </div>
            </form>
    </x-app-body>

</x-app-layout>
