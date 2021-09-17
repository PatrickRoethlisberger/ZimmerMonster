<x-app-layout>
    <x-slot name="header">
        </>
    </x-slot>

    <x-app-body>
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                Schlafplatz erstellen
            </h1>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('manage.bedtype.store') }}">
                @csrf

                <div class="mt-4">
                    <x-jet-label for="name" value="Name" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="sleepingspots" value="Schlafplätze" />
                    <x-jet-input id="sleepingspots" class="block mt-1 w-full" type="number" min="1" max="99" name="sleepingspots"
                        :value="old('sleepingspots')" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-jet-button>
                        Erstellen
                    </x-jet-button>
                </div>
            </form>
    </x-app-body>

</x-app-layout>
