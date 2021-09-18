<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                Hotel erstellen
            </h1>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('manage.hotel.store') }}">
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

                <div class="mt-4">
                    <x-jet-label for="stars" value="Anzahl Sterne" />
                    <x-jet-input id="stars" class="block mt-1 w-full" type="number" min="1" max="5" step="0.5" name="stars" :value="old('stars')" required />
                </div>

                @adminMember
                    <div class="mt-4">
                        <x-jet-label for="touristAssociation" class="col-md-4 col-form-label text-md-right">Verkehrsverein</x-jet-label>
                        <select class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" id="touristAssociation" name="touristAssociation_id">
                            <option value="" selected>Verkehrsverein auswählen</option>
                            @foreach($touristAssociations as $touristAssociation)
                                <option value="{{ $touristAssociation->id }}">{{ $touristAssociation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endadminMember

                <div class="flex items-center justify-end mt-4">
                    <x-jet-button>
                        Erstellen
                    </x-jet-button>
                </div>
            </form>
    </x-app-body>

</x-app-layout>
