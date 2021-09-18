{{-- components.filters.date.blade

Renders the datepicker for the date filter
To customize it you should shange the UI component used, YOU SHOULD NOT CUSTOMIZE ANYHING HERE
UI components used:
  - form/datepicker --}}


<x-lv-input
  :value="$value"
  :id="$id"
  wire:model="{{ $model }}"
  x-data="{ picker: null }"
  x-ref="{{ $id }}"
  x-init="picker = new Pikaday({ field: $refs['{{ $id }}'], format: 'DD-MM-YYYY', onSelect: () => $dispatch('input', picker.toString('YYYY-MM-DD')) })"
>
</x-lv-input>
<x-lv-input
  :value="$value"
  :id="$id"
  wire:model="{{ $model }}"
  x-data="{ picker: null }"
  x-ref="{{ $id }}"
  x-init="picker = new Pikaday({ field: $refs['{{ $id }}'], format: 'DD-MM-YYYY', onSelect: () => $dispatch('input', picker.toString('YYYY-MM-DD')) })"
>
</x-lv-input>
