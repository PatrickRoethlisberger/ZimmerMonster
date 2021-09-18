{{-- components/drop-down.blade

Renders the a dropdown button with its different variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,

- slots:
 - trigger
--}}

@props(['dropDownWidth' => 64, 'label' => ''])

<div
  class="relative"
  x-data="{ open: false }"
  @click.away="open = false"
  @close.stop="open = false"
>
  <span @click="open = ! open" class="cursor-pointer">
    @if ($label)
      <x-lv-select-button>
        {{ __($label) }}
      </x-lv-select-button>
    @else
      @isset($trigger)
        {{ $trigger }}
      @endisset
    @endif
  </span>

  <div x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95"
    class="bg-white shadow-lg rounded absolute top-8 right-0 border text-left z-10 w-{{ isset($dropDownWidth) ? $dropDownWidth : 'full' }}"
    x-show.transition="open"
    x-cloak
  >
    {{ $slot }}
  </div>
</div>
