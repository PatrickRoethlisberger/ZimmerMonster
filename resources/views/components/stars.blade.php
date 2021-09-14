<div class="flex items-center">
    @for ($i = 0; $i < $stars-0.5; $i++)
        <x-fas-star class="text-yellow-500 h-4" />
    @endfor
    @if (substr($stars, -1) == 5)
        <x-fas-star-half-alt class="text-yellow-500 h-4" />
    @endif
    @for ($i = 0; $i < 5-$stars-0.5; $i++)
        <x-far-star class="text-gray-400 h-4" />
    @endfor
</div>
