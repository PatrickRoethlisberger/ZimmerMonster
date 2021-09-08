<div class="sm:grid sm:grid-cols-3 sm:gap-4">
    <div class="sm:col-span-1">
        <x-jet-label for="plz" class="col-md-4 col-form-label text-md-right">Postleitzahl</x-jet-label>
        <x-jet-input type="text" name="plz" id="plz" class="block mt-1 w-full" wire:model="plz"/>
    </div>

    <div class="mt-4 sm:mt-0 sm:col-span-2">
        <x-jet-label for="city" class="col-md-4 col-form-label text-md-right">Stadt</x-jet-label>
        @if ($cities->count() === 0)
            <x-jet-input type="text" id="city" name="city_name" class="block mt-1 w-full bg-gray-100" disabled value=""/>

        @elseif ($cities->count() === 1)
            <x-jet-input type="text" id="city" name="city_name" class="block mt-1 w-full bg-gray-100" readonly value="{{ $cities->first()->city }}"/>
            <x-jet-input type="text" name="city_id" class="hidden" readonly value="{{ $cities->first()->id }}"/>
        @else
            <div>
                <select class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" id="city" name="city_id">
                    <option value="" selected>Stadt auswählen</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>
</div>
