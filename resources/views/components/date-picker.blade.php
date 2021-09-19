<input
    x-data="{ picker: null }"
    x-ref="{{ $id }}"
    x-init="picker = new Pikaday({ field: $refs['{{ $id }}'], format: 'YYYY-MM-DD', firstDay: 1 , onSelect: () => $dispatch('input', picker.toString('YYYY-MM-DD')),})"
    type="text"
    {{ $attributes }}
    class="order-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
>
