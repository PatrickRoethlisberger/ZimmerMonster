<x-app-layout>
    <x-slot name="header">
        <x-manage-navigation-menu />
    </x-slot>

    <x-app-body>
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                Zimmer Preisklasse erstellen
            </h1>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('manage.roomCategory.store') }}">
                @csrf

                <div class="mt-4">
                    <x-jet-label for="name" value="Name" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-jet-button>
                        Erstellen
                    </x-jet-button>
                </div>
            </form>
    </x-app-body>

</x-app-layout>
