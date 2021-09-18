<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                Einrichtung erstellen
            </h1>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('manage.touristAssociation.store') }}">
                @csrf

                <div class="mt-4">
                    <x-jet-label for="name" value="Name" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="street" value="Strasse" />
                    <x-jet-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required autocomplete="address-line1" />
                </div>

                <div class="mt-4">
                    <livewire:city-selector />
                </div>

                <div class="mt-4">
                    <x-jet-label for="phone" value="Telefon Nummer" />
                    <x-jet-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-jet-button>
                        Erstellen
                    </x-jet-button>
                </div>
            </form>
    </x-app-body>

</x-app-layout>
